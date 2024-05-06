<div class="card">
    <div class="card-body" style="display: flex; justify-content: space-between">
        <div class="">
            <h3 class="card-title">{{$titleName}} {{$className}}{{$grade}}</h3>
            <p class="card-text">{{$totalName}} {{$totalResult}}</p>
        </div>
        <div style="width: 200px" class="">
            <a href="{{$linkBtn}}" class="show-add button-add-student">{{$nameBtn}}</a>

            <a href="{{$linkDetails}}" style="margin-top: 12px; font-size: 16px; display: flex; align-content: center;align-items: center; justify-content: center" class="button-add-student" >
                <span >
                    {{$nameLink}}
                </span>
            </a>

        </div>

    </div>
</div>
