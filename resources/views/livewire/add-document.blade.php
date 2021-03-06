<div class="row">
    <div class="col-12">
        <div class="card border">
            <div class="card-body pt-4">
                <form wire:submit.prevent="submit">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="start" class="form-label">Title Document</label>
                                <input type="text" required wire:model.defer="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="start" class="form-label">No Document</label>
                                <input type="text" wire:model.defer="nodoc" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="start" class="form-label">Document Category</label>
                                <select class="form-select" id="docat" wire:model.defer="category"
                                    wire:change="change"
                                    aria-label="Default select example" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categorys as $cat)
                                    <option value="{{$cat->id}}">{{$cat->desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="end" class="form-label">Issued date</label>
                                <input type="date" required wire:model.defer="createdate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="end" class="form-label">Expired date</label>
                                <input type="date" required wire:model.defer="expiredate" class="form-control">
                            </div>
                            <label for="reminder" class="form-label">Remind Me Before</label>
                            <div class="input-group mb-3">
                                <input type="number" required min="1" wire:model.defer="reminder" class="form-control">
                                <span class="input-group-text" id="basic-addon2">days</span>
                            </div>
                            <div class="mb-3">
                                <input type="file" accept=".pdf" required wire:model.defer="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="end" class="form-label"> File Location</label>
                                <input type="text" required wire:model.defer="docloc" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="end" class="form-label">Remark</label>
                                <input type="text" wire:model.defer="remark" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="start" class="form-label">Document Sub-Category</label>
                                <select class="form-select" id="forsubcat" wire:model.defer="subcategory"
                                    aria-label="Default select example" required>
                                    <option value="">Select Sub-Category</option>
                                    @foreach ($subcategorys as $subcat)
                                    <option value="{{$subcat->id}}">{{$subcat->desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="attachment" class="form-label">Document Owner</label>
                                <input type="email" wire:model.defer="pic" class="form-control">
                            </div>
                            <label for="person" class="form-label">Person in Notify</label>
                            @for ($i = 0; $i < $count ; $i++) 
                            <div class="input-group mb-3">
                                <input type="email" wire:model.defer="pin.{{$i}}" class="form-control" aria-describedby="button-addon2">
                                    @if ($i == 0)
                                    <button class="btn btn-primary" wire:click="plus" type="button"><i
                                            class="fas fa-user-plus"></i></button>
                                    @else
                                    <button class="btn btn-danger" wire:click="minus({{$i}})" type="button"><i
                                            class="fas fa-user-minus"></i></button>
                                    @endif
                            </div>
                            @endfor
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i> Save</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>