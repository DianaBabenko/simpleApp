<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div><br>
@if($post->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    ID: {{ $post->id }}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Создано</label>
                        <input type="text" value="{{ $post->created_at }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Изменено</label>
                        <input type="text" value="{{ $post->updated_at }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Опубликовано</label>
                        <input type="text" value="{{ $post->published_at }}" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
