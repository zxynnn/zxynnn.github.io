@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Home Page</h1>
    </div>

    <div class="section-body">
      <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card card-statistic-1">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Pengeluaran <code class="float-right">Bulan ini</code></h4>
              </div>
              <div class="card-body">
                Rp. {{ number_format($totalPengeluaran, 0,',','.') }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card card-statistic-1">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Pendapatan <code class="float-right">Bulan ini</code></h4>
              </div>
              <div class="card-body">
                Rp. {{ number_format($profit, 0,',','.') }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card card-statistic-1">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4> Sisa Keuntungan<code class="float-right">Bulan ini</code></h4>
              </div>
              <div class="card-body">
                Rp. {{ number_format($sisaKeuntungan, 0,',','.') }}
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Statistics</h4>
            </div>



            <!-- Menambahkan elemen kanvas untuk bagan  -->
            <div class="card-body">
              <div class="form-group">
                <label for="monthSelect">Pilih Bulan:</label>
                <select class="form-control" id="monthSelect">
                  <option value="1">Januari</option>
                  <option value="2">Februari</option>
                  <option value="3">Maret</option>
                  <option value="4">April</option>
                  <option value="5">Mei</option>
                  <option value="6">Juni</option>
                  <option value="7">Juli</option>
                  <option value="8">Agustus</option>
                  <option value="9">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                  <!-- Menambahkan opsi untuk bulan lain -->
                </select>
              </div>
              <!-- tambahan code untuk grafik otomatis menyesuaikan bulan -->
              <script>
                // Ambil elemen select bulan
                const monthSelect = document.getElementById('monthSelect');

                // Set opsi bulan yang dipilih menjadi bulan saat ini
                const currentDate = new Date();
                const currentMonth = currentDate.getMonth() + 1;
                monthSelect.value = currentMonth;

                // Buat fungsi untuk mengupdate grafik berdasarkan bulan yang dipilih
                function updateChart() {
                  const selectedMonth = monthSelect.value;
                  // Lakukan sesuatu dengan data grafik sesuai dengan bulan yang dipilih
                  // Misalnya, tampilkan data grafik untuk bulan yang dipilih
                  console.log(`Menampilkan data grafik untuk bulan ${selectedMonth}`);
                }

                // Panggil fungsi updateChart saat pemilihan bulan berubah
                monthSelect.addEventListener('change', updateChart);

                // Panggil updateChart pada awalnya untuk menampilkan data grafik bulan saat ini
                updateChart();
              </script>
              <canvas id="myChart" height="182"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Transaksi Terbaru</h4>
            </div>
            @forelse ($items as $index => $item)
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border">
                <li class="media">
                  <div class="media-body">
                    <div class="float-right text-primary">Pada : {{ date('d-m-Y', strtotime($item->created_at)) }}</div>
                    <div class="media-title">{{ $item->customer->name }}</div>
                    <span class="text-small text-muted">Telah melakukan transaksi sebesar Rp. {{ number_format($item->grand_total, 0,',',',') }}</span>
                  </div>
                </li>

              </ul>

            </div>
            @empty

            @endforelse
            <div class="text-center pt-1 pb-1 mb-4">
              <!-- untuk menghubungkan view ke transaksi yang sudah dilakukan -->
              <a href="{{ route('transaction.index') }}" class="btn btn-primary btn-lg btn-round">
                View All
              </a>
            </div>

          </div>
        </div>
      </div>
  </section>
</div>
@endsection

@section('addon-script')

<script src="{{ url('assets/modules/chart.min.js')}}"></script>

<script>
  // Mendapatkan elemen dan konteks kanvas
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart;

  // Berfungsi untuk mengambil data grafik berdasarkan bulan yang dipilih
  function fetchChartData(selectedMonth) {
    // Membuat permintaan AJAX atau mengambil data dari server berdasarkan bulan yang dipilih
    // Ganti URL dan parameter sesuai dengan implementasi backend Anda
    fetch('/api/getChartData?month=' + selectedMonth)
      .then(response => response.json())
      .then(data => {
        // Menginisialisasi atau memperbarui diagram berdasarkan data yang diterima
        if (!myChart) {
          // Initialize the chart
          myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ['Pengeluaran', 'Pendapatan', 'Sisa Keuntungan'],
              datasets: [{
                label: 'Bulan Ini',
                data: data,
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)', //warna grafik
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                  'rgba(255, 99, 132, 1)', //warna grafik
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    callback: function(value, index, values) {
                      return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                  }
                }
              }
            }
          });
        } else {
          // Memperbarui data diagram
          myChart.data.datasets[0].data = data;
          myChart.update();
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  // Menangani peristiwa perubahan elemen pilih bulan
  document.getElementById('monthSelect').addEventListener('change', function() {
    var selectedMonth = this.value;
    fetchChartData(selectedMonth);
  });

  // Mengambil data diagram untuk bulan awal yang dipilih
  var initialSelectedMonth = document.getElementById('monthSelect').value;
  fetchChartData(initialSelectedMonth);
</script>




@endsection