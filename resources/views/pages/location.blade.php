@extends('layouts.main')

@section('title', trans('navigation.contact'))


@section('content')

    <h2 class="title text-center">Գտիր Մեզ</h2>
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">


                <div class="demo">
                    <input type="checkbox" id="hd-1" class="hide"/>
                    <label for="hd-1" id="desc">@lang('cart.description')</label>
                    <div style="font-size: 16px;">
                        <div class="col-sm-12">
                            <div id="map" class="contact-map">
                                <div class="contact-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14041.410860060638!2d43.84954673582335!3d40.787551993917525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4041fb8dcd24090f%3A0xf68aa6bffe7a39c7!2sDiamond+Jewellery+Salon!5e0!3m2!1sru!2s!4v1524853747558"
                                            width="100%" height="350" frameborder="0" style="border:0"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="demo">
                    <input type="checkbox" id="hd-1" class="hide"/>
                    <label for="hd-1" id="desc">@lang('cart.description')</label>
                    <div style="font-size: 16px;">
                        <div class="col-sm-12">
                            <div id="map" class="contact-map">
                                <div class="contact-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14041.410860060638!2d43.84954673582335!3d40.787551993917525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4041fb8dcd24090f%3A0xf68aa6bffe7a39c7!2sDiamond+Jewellery+Salon!5e0!3m2!1sru!2s!4v1524853747558"
                                            width="100%" height="350" frameborder="0" style="border:0"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--/#contact-page-->

@endsection