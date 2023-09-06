@extends('../layout/' . $layout)

@section('subhead')
<title>Upload Bukti Foto</title>
@endsection

@section('subcontent')
<form action="{{ route('pengirimanProduk.update', $pengirimanProduk->id_pengirimanProduk) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="mt-6">
    @error('bukti_foto')
    <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
      <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $message }}
      <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
        <i data-feather="x" class="w-4 h-4"></i>
      </button>
    </div>
    @enderror
    <h1 class="text-3xl mb-5">Upload Foto</h1>
    <p>Silahkan upload bukti foto pengiriman!</p>
    <input type="hidden" name="status" value="2">
    <div class="flex items-center justify-center w-full shadow-md">
      <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-fit border-2 border-gray-50 border-dashed rounded-lg cursor-pointer bg-white dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 @error('bukti_foto') border-danger @enderror">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
          <img src="" class="my-0 rounded-lg w-32" id="output">
          <div class="flex flex-col items-center justify-center pt-5 pb-6" id="hilang">
            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
          </div>
        </div>

        <input id="dropzone-file" type="file" class="hidden" name="bukti_foto" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />

      </label>
    </div>
    <div class="mt-8">
      <label for="nm_penerima" class="form-label font-bold"> Nama Penerima </label>
      <input type="text" class="form-control w-full shadow-md @error('nm_penerima') border-danger @enderror" name="nm_penerima" id="nm_penerima" value="{{ old('nm_penerima') }}" placeholder="Masukkan Nama Penerima">
      @error('nm_penerima')
      <div class="text-danger mt-2 mx-1">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
  <div class="px-5 pb-8 text-center mt-5">
    <a href="/pengirimanProduk" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Kembali</a>
    <button type="submit" class="inline-flex items-center rounded-md border bg-red-600 px-6 py-2 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 btn btn-primary hover:bg-blue-900">Kirim</button>
  </div>
</form>

<script>
  document.getElementById('dropzone-file').addEventListener('change', function() {
    document.getElementById('hilang').style.display = 'none';
  });
</script>
@endsection