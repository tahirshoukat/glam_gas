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
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Complaints</h3>
                    <canvas id="complaintsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@2.0.0/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Commission Data
            const commissionData = @json($commissionData);

            // Extract and sort unique labels
            const labels = [...new Set(Object.values(commissionData).flatMap(data => Object.keys(data)))].sort();

            // Generate random colors for each dataset
            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            // Prepare datasets for the commission chart
            const datasets = Object.keys(commissionData).map(technicianId => {
                return {
                    label: `Technician ${technicianId}`,
                    data: labels.map(date => commissionData[technicianId][date] || 0),
                    fill: false,
                    borderColor: getRandomColor(),
                    tension: 0.1
                };
            });

            // Initialize the commission chart
            const ctx = document.getElementById('commissionChart').getContext('2d');
            const commissionChart = new Chart(ctx, {
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

            // Second Chart for Complaints
            const complaints = @json($complaints);

            // Count complaints per product category
            const productCount = {};
            complaints.forEach(complaint => {
                const product = complaint.product;
                if (!productCount[product]) {
                    productCount[product] = 0;
                }
                productCount[product]++;
            });

            const labels2 = Object.keys(productCount);
            const data2 = Object.values(productCount);

            // Initialize the complaints chart
            const ctx2 = document.getElementById('complaintsChart').getContext('2d');
            const complaintsChart = new Chart(ctx2, {
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
                            text: 'Complaints'
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
