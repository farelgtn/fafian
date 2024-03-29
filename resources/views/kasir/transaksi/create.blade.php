<div class="container-fluid pt-2">
    <div class="row p-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="">Kode Produk</label>
                        </div>
                        <div class="col-md-8">
                            <form method="GET">
                                <div class="d-flex">
                                    <select name="produk_id" class="form-control" id="">
                                        <option value="">Nama Produk</option>
                                        @foreach ($produk as $item)
                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary ml-2">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="/kasir/transaksi/detail/create" method="POST">
                        @csrf

                        <input type="hidden" name="transaksi_id" value="{{ Request::segment(3) }}">
                        <input type="hidden" name="produk_id" value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                        <input type="hidden" name="produk_name" value="{{ isset($p_detail) ? $p_detail->name : '' }}">
                        <input type="hidden" name="qty" value="{{ $qty }}">
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                        <input type="hidden" name="produk_stok" value="{{ isset($p_detail) ? $p_detail->stok : '' }}">

                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">Nama Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{isset($p_detail) ? $p_detail->name : '' }}" class="form-control" disabled name="nama_produk">
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">Harga Satuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{isset($p_detail) ? $p_detail->harga : '' }}" class="form-control" disabled name="harga_satuan">
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">QTY</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <a href="?produk_id={{ request ('produk_id') }}&act=min&qty={{$qty}}" class="btn btn-primary"><i data-feather="minus"></i></a>
                                    <input type="text" value="{{$qty}}" class="form-control" name="qty" disabled>
                                    <a href="?produk_id={{ request ('produk_id') }}&act=plus&qty={{$qty}}" class="btn btn-primary"><i data-feather="plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">Diskon</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" name="diskon" value="{{ isset($p_detail) ? format_rupiah($p_detail->diskon) : '' }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="">Stok Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="stok_produk" value="{{ isset($p_detail) ? $p_detail->stok : '' }}" disabled>
                        </div>
                    </div>

                        <div class="row mt-1">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <h6>Subtotal : Rp {{ format_rupiah($subtotal) }}</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <a href="/kasir/transaksi" class="btn btn-info"><i data-feather="arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary"> Tambah <i data-feather="arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>QTY</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($transaksi_detail as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->produk_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ 'Rp. '.format_rupiah($item->subtotal) }}</td>
                            <td>
                                <a href="/kasir/transaksi/detail/delete?id={{$item->id}}"><i data-feather="x"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <a href="/kasir/transaksi/detail/selesai/{{Request::segment(3)}}" class="btn btn-success"><i data-feather="check"></i> Selesai</a>
                    {{-- <a href="/kasir/transaksi/detail/pending/{{Request::segment(3)}}" class="btn btn-info"><i data-feather="file"></i> Pending</a> --}}
                </div>
            </div>
        </div>

    </div>

    <div class="row p-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="formDibayarkan" method="POST">
                        @csrf
                        <!-- Input for total belanja -->
                        <div class="form-group">
                            <label for="total_belanja">Total Belanja</label>
                            <div class="input-group">
                                <!-- Disabled input field for displaying total belanja -->
                                <input type="number" value="{{ $transaksi->total }}" name="total_belanja" class="form-control" disabled>
                            </div>
                        </div>
                        <!-- Input for dibayarkan -->
                        <div class="form-group">
                            <label for="dibayarkan">Uang Pembayaran</label>
                            <div class="input-group">
                                <!-- Buttons for preset dibayarkan values -->
                               {{--  <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(50000)">Rp 50,000</button>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(100000)">Rp 100,000</button>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(150000)">Rp 150,000</button>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(200000)">Rp 200,000</button>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(250000)">Rp 250,000</button>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(300000)">Rp 300,000</button>
                                    </div>
                                </div>--}}
                                <!-- Input field for custom dibayarkan value -->
                                <div class="input-group-prepend mt-2">
                                    <span class="input-group-text white-bg">Rp</span>
                                </div> 
                                <input type="number" name="dibayarkan" id="dibayarkan" value="{{ request('dibayarkan') }}" class="form-control mt-2">
                            </div>
                        </div>
                        <!-- Hidden input field for storing dibayarkan value -->
                        <input type="hidden" name="dibayarkan_hidden" value="{{ isset($transaksi) ? format_rupiah($transaksi->dibayarkan) : '' }}">
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-2" onclick="hitungKembalian()">Hitung</button>
                    </form>

                    <script>
                        function hitungKembalian() {
                    var dibayarkan = parseInt(document.getElementById('dibayarkan').value);
                    var totalBelanja = {{ $transaksi->total }};
                    var kembalian = dibayarkan - totalBelanja;

                    document.getElementById('kembalian').value = kembalian;

                    // Memeriksa apakah jumlah uang yang dibayarkan mencukupi
                    if (dibayarkan >= totalBelanja) {
                        // Mengaktifkan tombol "Selesai"
                        document.getElementById('btnSelesai').classList.remove('disabled');
                    } else {
                        // Menonaktifkan tombol "Selesai"
                        document.getElementById('btnSelesai').classList.add('disabled');
                    }

                    if (dibayarkan == 0) {
                        document.getElementById('kembalian-info').innerText = "Masukkan total tunai yang dibayarkan.";
                    } else if (dibayarkan > 0 && dibayarkan < totalBelanja) {
                        document.getElementById('kembalian-info').innerText = "Uang yang Anda masukkan kurang.";
                    } else {
                        document.getElementById('kembalian-info').innerText = "";
                    }
                }

                document.getElementById('formDibayarkan').addEventListener('submit', function(event) {
                    event.preventDefault(); // Mencegah pengiriman formulir default

                    var formData = new FormData(this);

                    // Kirim permintaan AJAX
                    fetch('/kasir/transaksi/{{ $transaksi->id }}/dibayarkan', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Tampilkan pesan sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Perhitungan berhasil.'
                            });

                            // Update nilai kembalian
                            document.getElementById('kembalian').value = data.kembalian;
                        } else {
                            // Tampilkan pesan error jika perhitungan gagal
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan dalam perhitungan.'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
                    </script>

                    <div class="form-group">
                        <label for="kembalian">Uang Kembalian</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text white-bg">Rp</span>
                            </div>
                            <input type="text" value="{{ $kembalian }}" class="form-control" id="kembalian" disabled>
                        </div>
                        <small id="kembalian-info" class="text-danger"><a href="alert"></a></small>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function setDibayarkan(value) {
            document.getElementById('dibayarkan').value = value;
        }
    </script>