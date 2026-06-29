// resources/js/price-chart.js
import { Chart, LineController, LineElement, PointElement, LinearScale,
         CategoryScale, Tooltip, Legend, Filler } from "chart.js";

Chart.register(LineController, LineElement, PointElement, LinearScale,
               CategoryScale, Tooltip, Legend, Filler);

export function initPriceChart(canvasId, chartData) {
    const ctx = document.getElementById(canvasId);
    if (!ctx || !chartData || !chartData.length) return;

    new Chart(ctx, {
        type: "line",
        data: {
            labels: chartData.map(d => d.date),
            datasets: chartData.map((vendor, i) => ({
                label: vendor.vendor,
                data: vendor.prices.map(p => p.price),
                borderColor: i === 0 ? "#C9A84C" : "#6B6B6B",
                backgroundColor: i === 0 ? "rgba(201,168,76,0.1)" : "rgba(107,107,107,0.1)",
                borderWidth: 2,
                pointRadius: 4,
                tension: 0.3,
                fill: true,
            }))
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: chartData.length > 1 },
                tooltip: {
                    callbacks: {
                        label: ctx => `₦${ctx.parsed.y.toLocaleString("en-NG")}`,
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: v => `₦${v.toLocaleString("en-NG")}`,
                    }
                }
            }
        }
    });
}

