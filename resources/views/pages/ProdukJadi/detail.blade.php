<script src="https://cdn.tailwindcss.com"></script>
<div id="detail-{{ $produk->kd_produk }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="relative z-10" role="dialog" aria-modal="true">
        <button class="fixed inset-0 hidden bg-gray-500 bg-opacity-0 transition-opacity md:block" data-tw-dismiss="modal" type="button"></button>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4">
                <div class="relative w-[40rem] transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">
                    <div class="relative flex w-full items-center overflow-hidden bg-white px-4 pt-14 pb-8 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8 rounded-lg">
                        <button data-tw-dismiss="modal" type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="grid w-full grid-cols-1 items-start gap-y-8 gap-x-6 sm:grid-cols-12 lg:gap-x-8">
                            <div class="sm:col-span-4 lg:col-span-5">
                                <div class="overflow-hidden rounded-lg bg-gray-100 h-64 2xl:h-56 image-fit before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10">
                                    <img src="{{ asset('images/'.$produk->foto) }}" alt="Foto Produk." class="object-cover object-center">
                                </div>
                            </div>
                            <div class="sm:col-span-8 lg:col-span-7">
                                <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">{{ $produk->nm_produk }}</h2>
                                <section aria-labelledby="information-heading" class="mt-3">
                                    <h3 id="information-heading" class="sr-only">Produk Informasi</h3>
                                    <div class="flex items-center">
                                        <i data-feather="link" class="w-4 h-4 mr-2"></i> Modal : Rp. {{ number_format($produk->modal, 0, ',', '.') }}
                                    </div>
                                    <div class="flex items-center mt-3">
                                        <i data-feather="link" class="w-4 h-4 mr-2"></i> Harga : Rp. {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                    </div>
                                    <div class="mt-3">
                                        <div class="flex items-center mt-2">
                                            <i data-feather="box" class="w-4 h-4 mr-2"></i> Stok : {{ $produk['stok']}} Pcs
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="flex items-center mt-2">
                                            <i data-feather="box" class="w-4 h-4 mr-2"></i> Berat Produk : {{ $produk['berat'] * 1000}} Gram
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <h4 class="sr-only">Keterangan</h4>
                                        <p class="text-sm text-gray-700">{{ $produk['ket'] }}</p>
                                    </div>
                                </section>
                                @can('update', $produk)
                                <div class="mt-6">
                                    <a href="{{ route('produkJadi.edit',$produk->kd_produk) }}" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Edit</a>
                                </div>
                                @endcan
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>