@extends('../layout/' . $layout)

@section('subhead')
<title> {{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10">
    <h2 class="text-lg font-medium">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/datakaryawan" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('karyawan.create') }}">
            <button class="btn btn-primary shadow-md mr-2">Tambah Karyawan</button>
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
                    <th class="text-center whitespace-nowrap">FOTO</th>
                    <th class="text-center whitespace-nowrap">NIP</th>
                    <th class="text-center whitespace-nowrap">NAMA</th>
                    <th class="text-center whitespace-nowrap">JABATAN</th>
                    <th class="text-center whitespace-nowrap">TTL</th>
                    <th class="text-center whitespace-nowrap">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawan as $krywn)
                <tr class="intro-x">
                    <!-- agar nomer mengikuti pagination -->
                    <td class="text-center">{{ $loop->iteration + ($karyawan->currentPage() - 1) * $karyawan->perPage() }}</td>
                    <td class="text-center">
                        <img src="{{ asset('images/'.$krywn->foto) }}" class="w-20">
                    </td>
                    <td class="text-center">{{ $krywn->nip }}</td>
                    <td class="text-center">{{ $krywn->nm_karyawan }}</td>
                    <td class="text-center">{{ $krywn->nm_jabatan }}</td>
                    <td class="text-center">{{ $krywn->ttl }}</td>
                    <td class="table-report__action">
                        <div class="flex justify-center items-center">
                            <button class="flex items-center tooltip text-primary mr-2" data-theme="light" title="Detail" data-tw-toggle="modal" data-tw-target="#detail-{{ $krywn->id_karyawan }}">
                                <i data-feather="eye" class="w-4 h-4"></i>
                            </button>

                            <a class="flex items-center mr-2 tooltip text-success" data-theme="light" title="Edit" href="{{ route('karyawan.edit', $krywn->id_karyawan) }}">
                                <i data-feather="check-square" class="w-4 h-4"></i>
                            </a>

                            <!-- trigger modal -->
                            <button class="flex items-center tooltip text-danger" data-theme="light" title="Hapus" data-tw-toggle="modal" data-tw-target="#hapus{{ $krywn->id_karyawan }}">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                            </button>

                            <!-- BEGIN: Delete Confirmation Modal -->
                            <div id="hapus{{ $krywn->id_karyawan }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <form action="{{ route('karyawan.destroy', $krywn->id_karyawan) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-5 text-center">
                                                    <i data-feather="trash-2" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                    <div id="exampleModalLabel" class="text-2xl mt-5">Apakah yakin akan menghapus <br> {{ $krywn->nm_karyawan }}?</div>
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
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <div class="w-full sm:w-auto sm:mr-auto">
            {{ $karyawan->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->
</div>


@foreach ($karyawan as $kr)
    @include('pages.Karyawan.detail')
@endforeach

@endsection