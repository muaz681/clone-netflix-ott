
        <section id="iq-favorites">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center">
                            <h4 class="main-title">
                                <a
                                    href="#">Combo Package</a>
                            </h4>
                            {{-- @foreach ($categories['data'] as $key => $value)
                        <a href="{{ route('frontend.media_list', $value->slug) }}" class="category-see-more"> See More</a>
                    @endforeach --}}
        

                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">
                                {{-- @dd($slider['data']) --}}
                                {{-- @foreach ($slider['data'] as $key => $value) --}}
                                    <!-- Favorite Movie Slider Start -->
                                    @include('layouts.part.combo_slider')
                                    <!-- Favorite Movie Slider End -->
                                {{-- @endforeach --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

