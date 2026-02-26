<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 250 250" id="landmapSvg">
    <!-- Background statik -->
    <path d="m234.3 6.61h-219.2v236.8h219.2v-236.8z" fill="#000" />
    <path
        d="m16.77 7.68v234.2h173.8v-233.8h-14.68v38.07c0 6.24-4.6 8.82-8.13 8.82h-80.9c-13.75 0-24.47 11.2-24.47 26.29v91.81c0 5.8-3.83 9.04-8.56 9.04h-37.11v15.03h151c5.46 0 8.21 5.68 8.21 8.68v36.04h14.68v0.46h43.06v-234.6h-216.9z"
        fill="#fff" stroke="#000" stroke-miterlimit="10" stroke-width="1.06" />

    <!-- Loop unit dinamis -->
    @foreach ($unitsForSvg as $unit)
        @if (isset($unitPaths[$unit->unit_code]))
            <path
                d="{{ $unitPaths[$unit->unit_code] }}"
                fill="{{ $unit->fillColor }}"
                stroke="#000"
                stroke-miterlimit="10"
                stroke-width="1.06"
                data-unit="{{ $unit->unit_code }}"
                data-status="{{ $unit->status }}"
                data-tipe="{{ $unit->type }}"
                style="cursor:pointer;"
            />
        @endif
    @endforeach
</svg>

<!-- Div untuk menampilkan detail unit -->
<div id="unitDetail" style="margin-top:10px; padding:5px; border:1px solid #000; display:none;"></div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const paths = document.querySelectorAll('svg path[data-unit]');
    const detailDiv = document.getElementById('unitDetail');

    paths.forEach(path => {
        path.addEventListener('click', () => {
            const unitCode = path.dataset.unit;
            const status = path.dataset.status;
            const tipe = path.dataset.tipe;

            detailDiv.style.display = 'block';
            detailDiv.innerHTML = `
                <strong>Unit:</strong> ${unitCode}<br>
                <strong>Status:</strong> ${status}<br>
                <strong>Tipe:</strong> ${tipe}
            `;
        });
    });
});
</script>