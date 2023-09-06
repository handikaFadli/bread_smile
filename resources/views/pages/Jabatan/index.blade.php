@extends('../layout/' . $layout)

@section('subhead')
<title> {{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10">
    <h2 class="text-lg font-medium">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/jabatan" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 xl:col-span-6 lg:col-span-12 flex flex-wrap sm:col-span-12 md:col-span-12 sm:flex-nowrap items-center mt-2">
        <button class="btn btn-primary shadow-md mr-2" data-tw-toggle="modal" data-tw-target="#tambahJabatan">Tambah Jabatan</button>
        <!--<div class="dropdown">-->
        <!--    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">-->
        <!--        <span class="w-5 h-5 flex items-center justify-center">-->
        <!--            <i class="w-4 h-4" data-feather="plus"></i>-->
        <!--        </span>-->
        <!--    </button>-->
        <!--    <div class="dropdown-menu w-40">-->
        <!--        <ul class="dropdown-content">-->
        <!--            <li>-->
        <!--                <a href="" class="dropdown-item">-->
        <!--                    <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="" class="dropdown-item">-->
        <!--                    <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="" class="dropdown-item">-->
        <!--                    <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF-->
        <!--                </a>-->
        <!--            </li>-->
        <!--        </ul>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="hidden md:block mx-auto"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500">
                <form action="">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search..." autocomplete="off" name="search" value="{{ request('search') }}">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN: Data List -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 xl:col-span-6 lg:col-span-12 overflow-auto md:col-span-12 sm:col-span-12 lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">NO.</th>
                    <th class="whitespace-nowrap">NAMA JABATAN</th>
                    <th class="whitespace-nowrap text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jabatan as $jbtn)
                <tr class="intro-x">
                    <td class="">{{ $jabatan->firstItem() + $loop->index }}</td>
                    <td class="">{{ $jbtn->nm_jabatan }}</td>
                    <td class="table-report__action">
                        <div class="flex justify-center items-center">
                            <button class="flex items-center tooltip text-success mr-3" data-tw-toggle="modal" data-theme="light" title="Edit" data-tw-target="#editJabatan-{{ $jbtn->id_jabatan }}">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                            </button>

                            <!-- trigger modal -->
                            <button class="flex items-center tooltip text-danger" data-tw-toggle="modal" data-theme="light" title="Hapus" data-tw-target="#hapus{{ $jbtn->id_jabatan }}">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                            </button>
                            <!-- BEGIN: Delete Confirmation Modal -->
                            <div id="hapus{{ $jbtn->id_jabatan }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <form action="{{ route('jabatan.destroy', $jbtn->id_jabatan) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-5 text-center">
                                                    <i data-feather="trash-2" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                    <div id="exampleModalLabel" class="text-2xl mt-5">Apakah yakin ingin menghapus <br> {{ $jbtn->nm_jabatan }} ?</div>
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
            {{ $jabatan->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->

</div>


{{-- modal tambah data --}}
@include('pages.Jabatan.create')

{{-- modal edit data --}}
@foreach ($jabatan as $jb)
@include('pages.Jabatan.edit')
@endforeach

@endsection
