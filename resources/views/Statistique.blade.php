@extends('layouts.DashboardLayout')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <div class="stateItems">

    <div class='ItemsStateComponent' >
        <div class='H-ItemsStateComponent' >
        <span class='NameState' >Total Patient</span>
        </div>
        <div class='C-ItemsStateComponent' >
        <div class='T-ItemsStateComponent' >{{$totalpatient}}</div>
        <div class='I-ItemsStateComponent  bg-warning '  ><i class="  text-light fa-solid fa-user"></i></div>
        </div>
    </div>



    <div class='ItemsStateComponent' >
        <div class='H-ItemsStateComponent' >
        <span class='NameState' >Total consultations</span>
        </div>
        <div class='C-ItemsStateComponent' >
        <div class='T-ItemsStateComponent' >{{$totalconsultations}}</div>
        <div class='I-ItemsStateComponent bg-success  '><i class="fa-solid  text-light fa-user"></i></div>
        </div>
    </div>


    <div class='ItemsStateComponent' >
        <div class='H-ItemsStateComponent' >
        <span class='NameState' >Total medecin</span>
        </div>
        <div class='C-ItemsStateComponent' >
        <div class='T-ItemsStateComponent' >{{$totalmedecin}}</div>
        <div class='I-ItemsStateComponent  bg-danger '  ><i class="fa-solid  text-light  fa-user"></i></div>
        </div>
    </div>



    <div class='ItemsStateComponent' >
        <div class='H-ItemsStateComponent' >
        <span class='NameState' >Total infermiere</span>
        </div>
        <div class='C-ItemsStateComponent' >
        <div class='T-ItemsStateComponent' >{{$totalinfermiere}}</div>
        <div class='I-ItemsStateComponent bg-primary '  ><i class="fa-solid text-light fa-user"></i></div>
        </div>
    </div>


    <div class='ItemsStateComponent' >
        <div class='H-ItemsStateComponent' >
        <span class='NameState' >Total asistant</span>
        </div>
        <div class='C-ItemsStateComponent' >
        <div class='T-ItemsStateComponent' >{{$totalasistant}}</div>
        <div class='I-ItemsStateComponent bg-primary '  ><i class="fa-solid text-light fa-user"></i></div>
        </div>
    </div>

    <div class='ItemsStateComponent' >
        <div class='H-ItemsStateComponent' >
        <span class='NameState' >Total Other Employe</span>
        </div>
        <div class='C-ItemsStateComponent' >
        <div class='T-ItemsStateComponent' >{{$totalotherEmploye}}</div>
        <div class='I-ItemsStateComponent bg-primary '  ><i class="fa-solid text-light fa-user"></i></div>
        </div>
    </div>

    <div class='ItemsStateComponent' >
        <div class='H-ItemsStateComponent' >
        <span class='NameState' >Total paid</span>
        </div>
        <div class='C-ItemsStateComponent' >
        <div class='T-ItemsStateComponent' >{{$totalpaid}} DH</div>
        <div class='I-ItemsStateComponent bg-primary '  ><i class="fa-solid text-light fa-user"></i></div>
        </div>
    </div>

    <div class='ItemsStateComponent' >
        <div class='H-ItemsStateComponent' >
        <span class='NameState' >Total not paid</span>
        </div>
        <div class='C-ItemsStateComponent' >
        <div class='T-ItemsStateComponent' >{{$totalnotpaid}} DH</div>
        <div class='I-ItemsStateComponent bg-primary '  ><i class="fa-solid text-light fa-user"></i></div>
        </div>
    </div>


</div>
            <div class="c-container">
                <div class="c-container-two">
                    <canvas  id="consultationsChart"  style='background-color:#fff;border-radius:10px' width="300" height="150"></canvas>
                    <canvas  id="paymentsChart"  style='background-color:#fff;border-radius:10px' width="400" height="200"></canvas>
                </div>
                <div class="c-container-two">
                    <canvas  id="Pie"  style='background-color:#fff;border-radius:10px' width="100" height="100"></canvas>
                </div>
            </div>

    </div>


    <script>
        var ctx = document.getElementById('paymentsChart').getContext('2d');

        var paymentsData = @json($incomes);

        var labels = paymentsData.map(function(item) {
            return item.year + '-' + ('0' + item.month).slice(-2);
        });

        var data = paymentsData.map(function(item) {
            return item.total_payment;
        });

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Payment',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>



    <script>
        var data = @json($data);

        var labels = data.map(function(item) {
            return item.month;
        });

        var counts = data.map(function(item) {
            return item.count;
        });

        var colors = [
            '#3498db', // Light Blue
    '#2980b9', // Medium Blue
    '#1f618d', // Dark Blue
    '#2ecc71', // Light Green
    '#27ae60', // Medium Green
    '#229954', // Dark Green
    '#3498db', // Blue (Positive)
    '#e74c3c', // Red (Negative)
    '#3498db', // Light Blue
    '#2980b9', // Medium Blue
    '#1f618d', // Dark Blue
    '#3498db', // Blue (Category A)
    '#e67e22', // Orange (Category B)
    '#2ecc71', // Green (Category C)
    '#9b59b6', // Purple (Category D)
        ];

        var backgroundColors = colors.slice(0, data.length);

        var ctx = document.getElementById('consultationsChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Consultations Count',
                    data: counts,
                    backgroundColor: backgroundColors,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                }
            }
        });
    </script>





<script>

var serviceData = {!! $services !!};
var labelsPie = serviceData.map(service => service.nom);
var dataPie = serviceData.map(service => service.patients_count);

var ctx = document.getElementById('Pie').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labelsPie,
        datasets: [{
            data: dataPie,
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
            ],
        }],
    },
});

// second pie
var ctx = document.getElementById('Pie2').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labelsPie,
        datasets: [{
            data: dataPie,
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
            ],
        }],
    },
});



</script>









<script>
    var data = @json($incomes);

    var labels = data.map(function(item) {
        return item.month;
    });

    var counts = data.map(function(item) {
        return item.total_tarif;
    });

    var colors = [
        '#3498db', // Light Blue
'#2980b9', // Medium Blue
'#1f618d', // Dark Blue
'#2ecc71', // Light Green
'#27ae60', // Medium Green
'#229954', // Dark Green
'#3498db', // Blue (Positive)
'#e74c3c', // Red (Negative)
'#3498db', // Light Blue
'#2980b9', // Medium Blue
'#1f618d', // Dark Blue
'#3498db', // Blue (Category A)
'#e67e22', // Orange (Category B)
'#2ecc71', // Green (Category C)
'#9b59b6', // Purple (Category D)
    ];

    var backgroundColors = colors.slice(0, data.length);

    var ctx = document.getElementById('incomesChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'incoms par month',
                data: counts,
                backgroundColor: backgroundColors,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });
</script>
@endsection
