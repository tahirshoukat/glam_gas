<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Technician Commission per Day</h3>
                    <canvas id="commissionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Complaints and Associated Inventories</h3>
                    <canvas id="complaintsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@2.0.0/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const commissionData = @json($commissionData);

            const labels = [...new Set(Object.values(commissionData).flatMap(data => Object.keys(data)))].sort();

            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            const datasets = Object.keys(commissionData).map(technicianId => {
                return {
                    label: `Technician ${technicianId}`,
                    data: labels.map(date => commissionData[technicianId][date] || 0),
                    fill: false,
                    borderColor: getRandomColor(),
                    tension: 0.1
                };
            });

            const ctx = document.getElementById('commissionChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Commission per Technician per Day'
                        }
                    },
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'MMM dd',
                                displayFormats: {
                                    day: 'MMM dd'
                                }
                            }
                        }
                    }
                }
            });

            // Second Chart
            const complaints = @json($complaints);

            const inventoryCount = {};
            complaints.forEach(complaint => {
                const inventoryName = complaint.inventory_name;
                if (!inventoryCount[inventoryName]) {
                    inventoryCount[inventoryName] = 0;
                }
                inventoryCount[inventoryName]++;
            });

            const labels2 = Object.keys(inventoryCount);
            const data2 = Object.values(inventoryCount);

            const ctx2 = document.getElementById('complaintsChart').getContext('2d');
            const chart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: labels2,
                    datasets: [{
                        label: 'Number of Complaints',
                        data: data2,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Complaints and Associated Inventories'
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>