<div>
    <section class="new-products">
        <div class="site-width">
            <div class="new-products-block">
                    <form wire:submit="save" class="form-proposal">
                        <h1>{{__('proposal.h1')}}</h1>
                        <div class="form-proposal-item">
                            <label> {{__('label.name_car')}} </label>
                            <input type="text" wire:model="name_car">
                            <div>
                                @error('name_car')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-proposal-item">
                            <label> {{__('label.vin_car')}} </label>
                            <input type="text" wire:model="vin_car">
                            <div>
                                @error('vin_car')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-proposal-item">
                            <label> {{__('label.model_tow_track')}} </label>
                            <input type="text" wire:model="model_tow_track">
                            <div>
                                @error('model_tow_track')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-proposal-item">
                            <label> {{__('label.number_tow_track')}} </label>
                            <input type="text" wire:model="number_tow_track">
                            <div>
                                @error('number_tow_track')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-proposal-item">
                            <label> {{__('label.number_trailer')}} </label>
                            <input type="text" wire:model="number_trailer">
                            <div>
                                @error('number_trailer')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-proposal-item">
                            <label> {{__('label.name_driver')}} </label>
                            <input type="text" wire:model="name_driver">
                            <div>
                                @error('name_driver')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-proposal-item">
                            <label> {{__('label.passport_driver')}} </label>
                            <input type="text" wire:model="passport_driver">
                            <div>
                                @error('passport_driver')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-proposal-item">
                            <label> {{__('label.phone_driver')}} </label>
                            <input type="text" wire:model="phone_driver">
                            <div>
                                @error('phone_driver')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-proposal-item">
                            <label> {{__('label.date_pick_up')}} </label>
                            <input type="date" wire:model="date_pick_up">
                            <div>
                                @error('date_pick_up')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if(session('success'))
                        <span class="success">{{session('success')}}</span>
                        @endif
                        <div class="product-bottom">
                            <div class="product-bottom-buy">
                                <button type="submit" class="btn btn-buy">
                                    {{__('button.save')}}
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </section>
</div>
