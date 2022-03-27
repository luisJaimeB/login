<template>
  <div class="modal" tabindex="-1" id="detailModal" aria-labelledby="detailModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="card-header card-header-primary">
          <div class="modal-title card-title">@lang('products.titles.products')</div>
          <p class="card-category">@lang('products.titles.detailProd')<strong>{{ $product.name }}</strong></p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--   <div class="card modal-fade">
    <div class="card-header card-header-primary">
      <div class="card-title">@lang('products.titles.products')</div>
      <p class="card-category">@lang('products.titles.detailProd')<strong>{{ $product->name }}</strong></p>
    </div>
    <div class="card-body">
      <div class="row d-flex justify-content-center">
        <div class="col-md-4">
          <div class="card card-user">
            <div class="card-body">
              @if (session('success'))
                  <div class="alert alert-success" role="success">
                      {{ session('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>    
              @endif
              <p class="card-text">
                <div class="author">
                  <a href="#" class="">
                    <h5 class="title mx-3">{{ $product->name }}</h5>
                    <img class="card-img-top" src="{{ $product->image->path_url }}" alt="Card image cap">
                  </a>
                  <p class="description">
                    <h3>{{ $product->name }}</h3><br>
                    <div class="row">     
                      <div class="table-responsive">
                        <table class="table">
                          <thead class="text-primary text-center">
                            <th>@lang('products.fields.categories.th')</th>
                            <th>@lang('products.fields.publicationDate')</th>
                          </thead>
                          <tbody class="text-primary text-center">
                            <tr>
                              <td><h3><span class="badge rounded-pill bg-success text-white">{{ $product->category->name }}</span></h3></td>
                              <td><h3><span class="badge rounded-pill bg-info text-white">{{ $product->created_at->format('Y/m/d') }}</span></h3></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div> 
                    <label for="description">@lang('products.fields.description.label')</label><br>
                    <p>{{ $product->description }}</p><br>          
                  </p>
                </div>
              </p>                                          
            </div>
            <div class="card-footer d-flex justify-content-center">
              <div class="button-container">
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-success mr-3">@lang('common.return')</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary mr-3">@lang('common.edit')</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</template>

<script>
export default {
  props: {
    product: {
      type: Object,
    },
  },
  mounted(){
    this.getProduct()
  },
  data(){
    return {
      products: [],
      info: [],
    }
  },
};
</script>
