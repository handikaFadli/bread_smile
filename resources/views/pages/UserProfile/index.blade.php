@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
    @if ($karyawan !== null)
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Profile Layout</h2>
    </div>
    <!-- BEGIN: Profile Info -->
    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y box col-span-12 lg:col-span-8 px-5 pt-5 mt-5">
            <div class="border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        <img alt="Profile" class="rounded-full" src="{{ asset('images/'.$karyawan->foto) }}">
                        <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-primary rounded-full p-2">
                            <i class="w-4 h-4 text-white" data-feather="camera"></i>
                        </div>
                    </div>
                    <div class="ml-5">
                        <div class="truncate sm:whitespace-normal font-medium text-xl">{{ $dataKaryawan['namaDepan'] }}</div>
                        <div class="text-slate-500">{{ $karyawan->role }}</div>
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-6 text-lg pl-2">Data Profile Karyawan</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td class="">NIP</td>
                                    <td><span class="mr-2">:</span>{{ $karyawan->nip }}</td>
                                </tr>
                                <tr>
                                    <td class="">Nama Lengkap</td>
                                    <td><span class="mr-2">:</span>{{ $karyawan->nm_karyawan }}</td>
                                </tr>
                                <tr class="">
                                    <td class="">Jabatan</td>
                                    <td><span class="mr-2">:</span>{{ $karyawan->nm_jabatan }}</td>
                                </tr>
                                <tr>
                                    <td class="">Jenis Kelamin</td>
                                    <td><span class="mr-2">:</span>{{ $karyawan->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td class="">Status</td>
                                    <td><span class="mr-2">:</span>{{ $karyawan->status }}</td>
                                </tr>
                                <tr>
                                    <td class="">Tempat Lahir</td>
                                    <td><span class="mr-2">:</span>{{ $dataKaryawan['tempatLahir']. ', ' . date('d F Y', strtotime($dataKaryawan['tglLahir'])) }}</td>
                                </tr>
                                <tr>
                                    <td class="">Alamat Rumah</td>
                                    <td><span class="mr-2">:</span>{{ $dataKaryawan['alamatRumah'] }}</td>
                                </tr>
                                <tr>
                                    <td class="">Kecamatan</td>
                                    <td><span class="mr-2">:</span>{{ $dataKaryawan['kecamatan'] }}</td>
                                </tr>
                                <tr class="">
                                    @if ($dataKaryawan['selectKota'] == 'kota')
                                        <td class="">Kota</td>
                                    @else
                                        <td class="">Kabupaten</td>
                                    @endif
                                    <td><span class="mr-2">:</span>{{ $dataKaryawan['kota'] }}</td>
                                </tr>
                                <tr>
                                    <td class="">Provinsi</td>
                                    <td><span class="mr-2">:</span>{{ $dataKaryawan['provinsi'] }}</td>
                                </tr>
                                <tr>
                                    <td class="">Kode Pos</td>
                                    <td><span class="mr-2">:</span>{{ $dataKaryawan['kodepos'] }}</td>
                                </tr>
                                <tr>
                                    <td class="">No. HP</td>
                                    <td><span class="mr-2">:</span>{{ $karyawan->no_telp }}</td>
                                </tr>
                                <tr>
                                    <td class="">Pendidikan Terakhir</td>
                                    <td><span class="mr-2">:</span>{{ $karyawan->pendidikan }}</td>
                                </tr>
                                <tr>
                                    <td class="">Tanggal Masuk</td>
                                    <td><span class="mr-2">:</span>{{ date('d F Y', strtotime($karyawan->tanggal_masuk)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        
                        {{-- <br>
                        <div class="truncate sm:whitespace-normal flex items-center w-full border-b-2 pb-2">
                            <i data-feather="mail" class="w-4 h-4 mr-2"></i> {{ $karyawan->nip }}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="mail" class="w-4 h-4 mr-2"></i> {{ $karyawan->ttl }}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="instagram" class="w-4 h-4 mr-2"></i> {{ $karyawan->no_telp }}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="twitter" class="w-4 h-4 mr-2"></i> {{ $karyawan->alamat }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @elseif($sopir !== null )
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Profile Layout</h2>
    </div>
    <!-- BEGIN: Profile Info -->
    
    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y box col-span-12 lg:col-span-8 px-5 pt-5 mt-5">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        <img alt="Icewall Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('images/'.$sopir->foto) }}">
                        <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-primary rounded-full p-2">
                            <i class="w-4 h-4 text-white" data-feather="camera"></i>
                        </div>
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">Data Profile Sopir</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-feather="headphones" class="w-4 h-4 mr-2"></i> {{ $sopir->nm_sopir }}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="user" class="w-4 h-4 mr-2"></i> {{ $sopir->jenis_kelamin }}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-feather="award" class="w-4 h-4 mr-2"></i> {{ $sopir->no_ktp }}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3 mb-5">
                            <i data-feather="map-pin" class="w-4 h-4 mr-2"></i> {{ $sopir->alamat }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection