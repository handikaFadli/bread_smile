<div id="tambahLokasi" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Tambah Data</h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <form action="{{ route('lokasiPengiriman.store') }}" method="POST">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12">
                        <label for="tempat" class="form-label">Nama Tempat</label>
                        <input id="tempat" type="text" name="tempat" class="form-control shadow-md" placeholder="Silahkan masukkan" required autofocus>
                    </div>
                </div>
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea id="alamat" type="text" name="alamat" class="form-control shadow-md" placeholder="Silahkan masukkan" required></textarea>
                    </div>
                </div>
                <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Kembali</button>
                    <button type="submit" class="btn btn-primary w-20">Kirim</button>
                </div>
            </form>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>