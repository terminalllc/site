<div>
    @if (count((array)$car))
    <section class="new-products" wire:key="car-{{ $car->id }}">
        <div class="site-width">
            <div class="new-products-block">
                <div class="row">
                    <div class="col product-col">
                        <div style="display: flex; flex-direction: row;">
                            <span class="span_name">{{__('label.name')}}: </span>
                            <span class="span_value"> {{ $car->name }}</span>
                        </div>
                        <div style="display: flex; flex-direction: row;">
                            <span class="span_name">{{__('label.vin')}}: </span>
                            <span class="span_value"> {{ $car->vin }}</span>
                        </div>
                        <div style="display: flex; flex-direction: row;">
                            <span class="span_name">{{__('label.date_on_terminal')}}: </span>
                            <span class="span_value"> {{ $car->on_terminal_at }}</span>
                        </div>
                        <div style="display: flex; flex-direction: row;">
                            <span class="span_name">{{__('label.date_out_terminal')}}: </span>
                            <span class="span_value"> {{ $car->out_terminal_at }}</span>
                        </div>
                    </div>
                    <div class="col product-col">
                        @if(count($car->containerImages))
                        <div class="productrow">
                            <span class="span_strong">{{__('images.on_container')}}</span>
                            <div class="car_images">
                                <div class="product_img_block">
                                    @foreach ($car->containerImages as $image)
                                    @if ($loop->first)
                                    <a data-fancybox="gallery" data-src="{{$image}}">
                                        <div class="single_img">
                                            <img src="{{$image}}">
                                            <span class="span_image">{{__('images.view_all')}}</span>
                                        </div>
                                    </a>
                                    @elseif ($loop->index ==1)
                                    <div style="display: none">
                                        @elseif ($loop->index >1)
                                        <a data-fancybox="gallery" data-src="{{$image}}">
                                            <div class="single_img">
                                                <img src="{{$image}}">
                                            </div>
                                        </a>
                                        @else
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="product-bottom">
                                <div class="product-bottom-buy">
                                    <button wire:click="download({{ $car}}, 'containerImages')" class="btn btn-buy">{{__('button.download')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(count($car->terminalImages))
                        <div class="productrow">
                            <span class="span_strong">{{__('images.on_terminal')}}</span>
                            <div class="car_images">
                                <div class="product_img_block">
                                    @foreach ($car->terminalImages as $image)
                                    @if ($loop->first)
                                    <a data-fancybox="gallery1" data-src="{{$image}}">
                                        <div class="single_img">
                                            <img src="{{$image}}">
                                            <span class="span_image">{{__('images.view_all')}}</span>
                                        </div>
                                    </a>
                                    @elseif ($loop->index ==1)
                                    <div style="display: none">
                                        @elseif ($loop->index >1)
                                        <a data-fancybox="gallery1" data-src="{{$image}}">
                                            <div class="single_img">
                                                <img src="{{$image}}">
                                            </div>
                                        </a>
                                        @else
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="product-bottom">
                                <div class="product-bottom-buy">
                                    <button wire:click="download({{ $car}}, 'terminalImages')" class="btn btn-buy">{{__('button.download')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(count($car->outImages))
                        <div class="productrow">
                            <span class="span_strong">{{__('images.out_terminal')}}</span>
                            <div class="car_images">
                                <div class="product_img_block">
                                    @foreach ($car->outImages as $image)
                                    @if ($loop->first)
                                    <a data-fancybox="gallery2" data-src="{{$image}}">
                                        <div class="single_img">
                                            <img src="{{$image}}">
                                            <span class="span_image">{{__('images.view_all')}}</span>
                                        </div>
                                    </a>
                                    @elseif ($loop->index ==1)
                                    <div style="display: none">
                                        @elseif ($loop->index >1)
                                        <a data-fancybox="gallery2" data-src="{{$image}}">
                                            <div class="single_img">
                                                <img src="{{$image}}">
                                            </div>
                                        </a>
                                        @else
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="product-bottom">
                                <div class="product-bottom-buy">
                                    <button wire:click="download({{ $car}}, 'outImages')" class="btn btn-buy">{{__('button.download')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
