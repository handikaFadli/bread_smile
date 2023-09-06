@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10">
    <h2 class="text-lg font-medium">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/sopir" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('sopir.create') }}">
            <button class="btn btn-primary shadow-md mr-2">Tambah Sopir</button>
        </a>
        <div class="hidden md:block mx-auto text-slate-500"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500">
                <form action="">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search..." autocomplete="off" name="search" value="{{ request('search') }}">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </form>
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">NO.</th>
                    <th class="whitespace-nowrap text-center">FOTO</th>
                    <th class="whitespace-nowrap text-center">NOMOR KTP</th>
                    <th class="whitespace-nowrap text-center">NAMA</th>
                    <th class="whitespace-nowrap text-center">JENIS KELAMIN</th>
                    <th class="whitespace-nowrap text-center">ALAMAT</th>
                    <th class="whitespace-nowrap text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sopir as $spr)
                @if ($spr->hapus == 0)
                <tr class="intro-x">
                    <td class="text-center">{{ $loop->iteration + ($sopir->currentPage() - 1) * $sopir->perPage() }}</td>
                    <td class="text-center">
                        <img src="{{ asset('images/'.$spr->foto) }}" class="w-20">
                    </td>
                    <td class="text-center">{{ $spr->no_ktp }}</td>
                    <td class="text-center">{{ $spr->nm_sopir }}</td>
                    <td class="text-center">{{ $spr->jenis_kelamin }}</td>
                    <td class="text-center">{{ $spr->alamat }}</td>
                    <td class="table-report__action">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-2 tooltip text-success" data-theme="light" title="Edit" href="{{ route('sopir.edit', $spr->kd_sopir) }}">
                                <i data-feather="check-square" class="w-4 h-4"></i>
                            </a>

                            <!-- trigger modal -->
                            <button class="flex items-center tooltip text-danger" data-theme="light" title="Hapus" data-tw-toggle="modal" data-tw-target="#hapus{{ $spr->kd_sopir }}">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                            </button>

                            <!-- BEGIN: Delete Confirmation Modal -->
                            <div id="hapus{{ $spr->kd_sopir }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <form action="{{ route('sopir.destroy', $spr->kd_sopir) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-5 text-center">
                                                    <i data-feather="trash-2" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                    <div id="exampleModalLabel" class="text-2xl mt-5">Apakah yakin ingin menghapus <br> {{ $spr->nm_sopir }} ?</div>
                                                    <div class="mt-3">
                                                        <span class="text-danger">*data yang dihapus tidak dapat dikembalikan!</span>
                                                    </div>
                                                </div>
                                                <div class="px-5 pb-8 text-center">
                                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Kembali</button>
                                                    <button type="submit" class="btn btn-danger w-24">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Delete Confirmation Modal -->
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- END: Data List -->

    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <div class="w-full sm:w-auto sm:mr-auto">
            {{ $sopir->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->

</div>
@endsection