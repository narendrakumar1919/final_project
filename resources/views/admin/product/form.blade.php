<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="example-hf-password">Product Name</label>
    <div class="col-lg-7">
        {{ Form::text('product_name', null, ['class' => 'form-control', 'placeholder' => 'Product Name']) }}
        {{-- <input type="text" class="form-control" id="example-hf-password" name="auther_name" placeholder="Enter Auther Name.."> --}}
    </div>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="example-hf-password">Category Name</label>
    <div class="col-lg-7">
        {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select a category']) }}
    </div>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="example-textarea-input">Description</label>
    <div class="col-lg-7">
        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '6', 'placeholder' => 'Description']) }}
        {{-- <textarea class="form-control" id="example-textarea-input" name="description" rows="6" placeholder="Content.."></textarea> --}}
    </div>
</div>
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="example-textarea-input">Photo</label>
    <div class="col-lg-7">
        {{ Form::file('image', ['id' => 'selectImage']) }}
        {{-- <input type="file" id="example-file-input-custom" name="image" data-toggle="custom-file-input"> --}}
        <img id="preview" src="#" alt="your image" class="mt-3" style="display:none; height:50px; width:50px;"/>
    </div>

</div>
<div class="form-group row">
    <div class="col-lg-9 ml-auto">

        {{ Form::submit('Submit', ['class' => 'btn btn-alt-primary']) }}
        {{-- <button type="submit" class="btn btn-alt-primary">Submit</button> --}}
    </div>
</div>

