@if(session('success'))
<div class="alert alert-success text-center">
<p style="margin:0">{{ session('success') }}</p>
</div>
@endif