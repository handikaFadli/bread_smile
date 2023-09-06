<div id="tambahJabatan" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Tambah Data</h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <form action="{{ route('jabatan.store') }}" meth`od="POST">
            @csrf
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-12">
                    <label for="nm_jabatan" class="form-label">Nama Jabatan</label>
                    <input id="nm_jabatan" type="text" name="nm_jabatan" class="form-control shadow-md" placeholder="Silahkan masukkan" required autofocus>
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                <button type="submit" class="btn btn-primary w-20">Send</button>
            </div>
        </form>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>
