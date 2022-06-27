@isset($medias)
    <div class="container-fluid">
        <v-row>
            <div class="iq-main-header d-flex align-items-center justify-content-between">
                <h4 class="main-title">
                    <a href="javascript:void(0);">{{ isset($medias['cat_name']) ? $medias['cat_name']->title_english : null }}</a>
                </h4>
            </div>
        
                @forelse($medias['cat_med'] as $sdata)
                {{-- @dd($sdata) --}}
                    @isset($sdata)
                        <v-col
                            cols="6"
                            sm="3"
                            xs="6"
                            md="3"
                            lg="2"
                            xl="2"
                        >
                            <category-card :cdata="{{ $sdata->toJson() }}"
                                :member="{{ auth('member')->user() ? auth('member')->user() : '{}' }}"
                                paycurrency="{{ PayCurrency() }}"
                                local="{{ app()->getLocale() }}"
                            ></category-card>
                        </v-col>
                    @endisset
                @empty
                    @include('layouts.essential.empty')
                @endforelse
          
          
        </v-row>
      </div>
@endisset
