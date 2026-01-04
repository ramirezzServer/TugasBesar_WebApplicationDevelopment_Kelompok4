(() => {
    const DATA_URL = window.USER_DASHBOARD_DATA_URL;

    const elActive = document.getElementById("statActive");
    const elTransit = document.getElementById("statTransit");
    const elInactive = document.getElementById("statInactive");
    const elServerTime = document.getElementById("serverTime");

    const listEl = document.getElementById("vehiclesList");
    const markersEl = document.getElementById("mapMarkers");

    const searchInput = document.getElementById("searchInput");
    const btnRefresh = document.getElementById("btnRefresh");
    const filterBtns = document.querySelectorAll(".dash-filterBtn");

    let state = {
        vehicles: [],
        filter: "",
        search: "",
        selectedId: null,
    };

    function escapeHtml(str) {
        return String(str ?? "")
            .replaceAll("&", "&amp;")
            .replaceAll("<", "&lt;")
            .replaceAll(">", "&gt;")
            .replaceAll('"', "&quot;")
            .replaceAll("'", "&#039;");
    }

    function badge(status) {
        if (status === "active")
            return `<span class="badge badge--active">Beroperasi</span>`;
        if (status === "transit")
            return `<span class="badge badge--transit">Transit</span>`;
        return `<span class="badge badge--inactive">Tidak Aktif</span>`;
    }

    // Format: YYYY-MM-DD HH:mm WIB
    // NOTE: Backend disarankan kirim ISO8601 (now()->toIso8601String()) biar parsing aman.
    function formatWIB_YMD_HM(isoString) {
        if (!isoString) return "-";
        const d = new Date(isoString);
        if (Number.isNaN(d.getTime())) return "-";

        // "sv-SE" -> "2026-01-04 17:02"
        const formatted = new Intl.DateTimeFormat("sv-SE", {
            timeZone: "Asia/Jakarta",
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            hour12: false,
        }).format(d);

        return `${formatted} WIB`;
    }

    // posisi marker simulasi (karena DB tidak punya koordinat)
    function pseudoPos(vehicleId, halteId) {
        const v = Number(vehicleId) || 0;
        const h = Number(halteId) || 1;
        const seed = (v * 92821 + h * 68917) % 9973;
        const x = 10 + (seed % 80);
        const y = 12 + (Math.floor(seed / 11) % 68);
        return { x, y };
    }

    function applyFilterAndSearch(items) {
        const q = state.search.trim().toLowerCase();

        return items.filter((v) => {
            const okFilter = !state.filter || v.status === state.filter;
            if (!okFilter) return false;

            if (!q) return true;
            const hay = `${v.name} ${v.plat_nomor} ${v.route} ${v.location} ${v.driver}`.toLowerCase();
            return hay.includes(q);
        });
    }

    function renderList(items) {
        if (!items.length) {
            listEl.innerHTML = `<div class="dash-list__loading">Tidak ada data yang cocok.</div>`;
            return;
        }

        listEl.innerHTML = items
            .map((v) => {
                const selected = state.selectedId === v.id ? "is-selected" : "";
                return `
        <button class="dash-item ${selected}" data-id="${escapeHtml(
                    v.id
                )}" type="button">
          <div class="dash-item__top">
            <div>
              <div class="dash-item__title">
                <span>${escapeHtml(v.name)}</span>
                ${badge(v.status)}
              </div>
              <div class="dash-item__route">${escapeHtml(v.route)}</div>

              <div class="dash-item__meta">
                <span>📍 ${escapeHtml(v.location)}</span>
                <span>👤 ${escapeHtml(v.driver)}</span>
                <span>⏱️ ETA: ${escapeHtml(v.eta || "—")}</span>
                <span>🕒 ${escapeHtml(v.last_update || "-")}</span>
              </div>
            </div>
            <div class="dash-item__sub">›</div>
          </div>
        </button>
      `;
            })
            .join("");

        listEl.querySelectorAll("button[data-id]").forEach((btn) => {
            btn.addEventListener("click", () => {
                state.selectedId = btn.getAttribute("data-id");
                rerender();
            });
        });
    }

    function markerClass(status) {
        if (status === "active") return "dash-marker dash-marker--active";
        if (status === "transit") return "dash-marker dash-marker--transit";
        return "dash-marker dash-marker--inactive";
    }

    function renderMarkers(items) {
        // optional: hide inactive markers
        const visible = items.filter((v) => v.status !== "inactive");

        markersEl.innerHTML = visible
            .map((v) => {
                const { x, y } = pseudoPos(v.id, v.halte_id);
                const selected = state.selectedId === v.id ? "is-selected" : "";
                return `
        <button
          type="button"
          class="${markerClass(v.status)} ${selected}"
          data-id="${escapeHtml(v.id)}"
          style="left:${x}%; top:${y}%"
          title="${escapeHtml(v.name)}"
        >
          🚌
          <span class="dash-marker__label">${escapeHtml(v.plat_nomor)}</span>
        </button>
      `;
            })
            .join("");

        markersEl.querySelectorAll("button[data-id]").forEach((btn) => {
            btn.addEventListener("click", () => {
                state.selectedId = btn.getAttribute("data-id");
                rerender();
                const target = listEl.querySelector(
                    `button[data-id="${CSS.escape(state.selectedId)}"]`
                );
                if (target) target.scrollIntoView({ behavior: "smooth", block: "nearest" });
            });
        });
    }

    function rerender() {
        const filtered = applyFilterAndSearch(state.vehicles);
        renderList(filtered);
        renderMarkers(filtered);

        filterBtns.forEach((b) => {
            const f = b.getAttribute("data-filter") || "";
            b.classList.toggle("is-active", f === (state.filter || ""));
        });
    }

    async function fetchData() {
        try {
            const res = await fetch(DATA_URL, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
            });
            if (!res.ok) throw new Error("HTTP " + res.status);
            const data = await res.json();

            // server time: YYYY-MM-DD HH:mm WIB
            elServerTime.textContent = formatWIB_YMD_HM(data.server_time);

            elActive.textContent = data.counts?.active ?? 0;
            elTransit.textContent = data.counts?.transit ?? 0;
            elInactive.textContent = data.counts?.inactive ?? 0;

            state.vehicles = Array.isArray(data.vehicles) ? data.vehicles : [];
            rerender();
        } catch (e) {
            listEl.innerHTML = `<div class="dash-list__loading" style="color:#c4161c;font-weight:800;">Gagal load data realtime. Cek /dashboard/data & console.</div>`;
            // fallback time
            elServerTime.textContent = "-";
            console.error(e);
        }
    }

    btnRefresh?.addEventListener("click", fetchData);

    searchInput?.addEventListener("input", (e) => {
        state.search = e.target.value || "";
        rerender();
    });

    filterBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            state.filter = btn.getAttribute("data-filter") || "";
            rerender();
        });
    });

    fetchData();
    setInterval(fetchData, 8000);
})();