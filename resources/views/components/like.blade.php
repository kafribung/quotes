<button class="  btn  btn-sm  {{$model->multi_like()? "btn-danger unlike" :  "btn-primary like" }} "
    data-model-id="{{$model->id}}" data-type="{{$type}}">
    <i class=" fa {{$model->multi_like()?  "fa-thumbs-down" : "fa-thumbs-up" }} "></i>
</button>
<p class="count mt-1">{{$model->likes()->count()}}</p>
<p class="warning d-none text-danger">Tidak bisa like diri sendiri</p>