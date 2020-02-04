@php
    /** @var \App\Models\BlogCategory $category */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div><br>
@if($category->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>ID: {{ $category->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
@endif
