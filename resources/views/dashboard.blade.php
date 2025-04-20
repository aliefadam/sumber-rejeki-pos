@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-blue-700 rounded-lg">
                    <i class="fa-regular fa-box"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Jumlah Produk</p>
                    <h3 class="text-xl font-bold">{{ $product_count }}</h3>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-yellow-600 rounded-lg">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Jumlah Transaksi</p>
                    <h3 class="text-xl font-bold">{{ $transaction_count }}</h3>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-green-500 rounded-lg">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Pendapatan</p>
                    <h3 class="text-xl font-bold">{{ format_rupiah($income) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 mb-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Pendapatan Transaksi pada {{ date('Y') }}</h4>
            <div id="yearlyChart" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const yearlyChart = echarts.init(document.getElementById("yearlyChart"));
        const dataYearlyChart = @json($transaction_per_month);

        const yearlyOption = {
            animation: true,
            tooltip: {
                trigger: "axis",
            },
            xAxis: {
                type: "category",
                data: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agu",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
            },
            yAxis: {
                type: "value",
            },
            series: [{
                data: dataYearlyChart.map((data) => data.total_revenue),
                type: "line",
                smooth: true,
                lineStyle: {
                    color: "#4F46E5",
                },
                areaStyle: {
                    color: {
                        type: "linear",
                        x: 0,
                        y: 0,
                        x2: 0,
                        y2: 1,
                        colorStops: [{
                                offset: 0,
                                color: "rgba(79, 70, 229, 0.3)",
                            },
                            {
                                offset: 1,
                                color: "rgba(79, 70, 229, 0)",
                            },
                        ],
                    },
                },
            }, ],
        };
        yearlyChart.setOption(yearlyOption);

        window.addEventListener("resize", function() {
            yearlyChart.resize();
        });
    </script>
@endsection
