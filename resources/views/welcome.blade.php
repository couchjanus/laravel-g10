@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home Page</div>

                <div class="card-body">

                    <ais-index
                        app-id="{{ config('scout.algolia.id') }}"
                        api-key="{{ env('ALGOLIA_SEARCH') }}"
                        index-name="posts"
                      >
                        <ais-input placeholder="Search posts..."></ais-input>
                        <ais-results>
                          <template scope="{ result }">
                            <div>
                            <h2>@{{ result.title }}</h2>
                            <a :href="'/blog/'+ result.slug" class="btn btn-info">Continue reading</a>
                            </div>
                            
                          </template>
                          
                        </ais-results>
                        <ais-no-results></ais-no-results>

                        <ais-pagination class="pagination"  :padding=5 :class-names="{
                          'ais-pagination': 'pagination',
                          'ais-pagination__item--active': 'active',
                          'ais-pagination__item--disabled': 'disabled'
              
                          }"></ais-pagination>
              
               
                    </ais-index>
                    
        </div>
    </div>
</div>
@endsection
