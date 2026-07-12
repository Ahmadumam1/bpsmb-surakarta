<div class="hidden overflow-x-auto lg:block">
    <table class="w-full min-w-[960px] text-left">
        <thead class="sticky top-0 z-10 bg-[#08236f] text-white">
            <tr>
                <th class="w-16 px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">No</th>
                <th class="w-[230px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Kategori</th>
                <th class="px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Uraian Layanan</th>
                <th class="w-[160px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Satuan</th>
                <th class="w-[180px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Tarif</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-black/10">
            @if ($fees->isEmpty())
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center">
                        <p class="text-[15px] font-semibold text-[#1f2937]">Data tidak ditemukan.</p>
                        <p class="mt-1 text-sm text-[#71717a]">Coba gunakan kata kunci atau kategori lain.</p>
                    </td>
                </tr>
            @else
                @foreach ($fees as $item)
                    <tr class="transition odd:bg-white even:bg-[#f8fafc] hover:bg-[#fff8e1]">
                        <td class="px-5 py-4 align-top text-sm font-semibold text-[#71717a]">
                            {{ $fees->firstItem() + $loop->index }}
                        </td>
                        <td class="px-5 py-4 align-top">
                            <p class="text-[14px] font-medium leading-6 text-[#4b5563]">
                                {{ $item->category }}
                            </p>
                        </td>
                        <td class="px-5 py-4 align-top">
                            <p class="text-[15px] font-semibold leading-6 text-[#1f2937]">{{ $item->service_name }}</p>
                            @if ($item->description)
                                <p class="mt-1 text-sm leading-6 text-[#71717a]">{{ $item->description }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-4 align-top">
                            <p class="text-[14px] font-medium leading-6 text-[#4b5563]">
                                {{ $item->unit }}
                            </p>
                        </td>
                        <td class="px-5 py-4 align-top">
                            <p class="text-[14px] font-semibold leading-6 text-[#1f2937]">
                                {{ $item->formattedPrice() }}
                            </p>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<div class="grid gap-3 p-4 lg:hidden">
    @if ($fees->isEmpty())
        <div class="rounded-[8px] border border-black/10 bg-white p-8 text-center">
            <p class="text-[15px] font-semibold text-[#1f2937]">Data tidak ditemukan.</p>
            <p class="mt-1 text-sm text-[#71717a]">Coba gunakan kata kunci atau kategori lain.</p>
        </div>
    @else
        @foreach ($fees as $item)
            <div class="rounded-[8px] border border-black/10 bg-white p-4 shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
                <div class="grid gap-1.5">
                    <p class="text-[13px] font-medium leading-5 text-[#4b5563]">
                        {{ $item->category }}
                    </p>
                    <p class="text-[13px] font-medium leading-5 text-[#4b5563]">
                        {{ $item->unit }}
                    </p>
                    <p class="text-[13px] font-semibold leading-5 text-[#1f2937]">
                        {{ $item->formattedPrice() }}
                    </p>
                </div>
                <p class="mt-3 text-[15px] font-semibold leading-6 text-[#1f2937]">{{ $item->service_name }}</p>
                @if ($item->description)
                    <p class="mt-1 text-sm leading-6 text-[#71717a]">{{ $item->description }}</p>
                @endif
            </div>
        @endforeach
    @endif
</div>
