<div style="border-bottom: 1px solid #ddd;">
    <div style="font-size: 1.2rem;font-weight: bolder;font-family: sans-serif;">{{ $page_title }}</div>
    <div style="font-size: 0.7rem;">from {{ date('d-m-Y', strtotime(request('start'))) }} to
        {{ date('d-m-Y', strtotime(request('end'))) }}</div>

</div>
