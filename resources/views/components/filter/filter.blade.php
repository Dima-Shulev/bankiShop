<div class="container form-control mb-2 filter">
    <form action="{{ route('all.home') }}" method="get">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                 <label for="sortName" class="form-label m-2"><b>{{__('Сортировать по:')}}</b></label>
                 <select name="sort" id="sortName" class="mb-2">
                     <option value="false">{{__('-/-')}}</option>
                     <option value="upName">{{__('По имени a-z')}}</option>
                     <option value="upTime">{{__('По дате в прямом')}}</option>
                     <option value="downName">{{__('По имени z-a')}}</option>
                     <option value="downTime">{{__('По дате в обратном')}}</option>
                 </select>
            </div>
            <div>
                <input type="submit" name="sortImage" value="{{__('Сортировать')}}" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
