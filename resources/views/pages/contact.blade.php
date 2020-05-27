@extends('layouts.main')

@section('title', trans('navigation.contact'))

@section('content')

    <div id="contact-page" class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="contact-form">
                    <h2 class="title text-center">@lang('navigation.contact_us')</h2>
                    @if (session('message'))
                        <div class="status alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('contacting') }}" method="POST" id="main-contact-form" class="contact-form row" name="contact-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6">
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => '1', 'placeholder' => trans('order.name').' '.trans('order.last_name')]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::email('email', null, ['class' => 'form-control', 'required' => '1', 'placeholder' => trans('order.email')]) !!}
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" required="required"
                                   placeholder="@lang('navigation.title')">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="phone" class="form-control" required="required"
                                   placeholder="@lang('navigation.mob')">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"
                                      placeholder="@lang('order.message')"></textarea>
                        </div>
                        <div class="form-group col-md-12" style="text-align: center">
                            <input class="knopka" type="submit" value="@lang('navigation.send')">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="contact-info">
                    <h2 class="title text-center">@lang('navigation.our_contacts')</h2>
                    <address>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('navigation.site'):
                            http://lusijewelry.com</p>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('order.email'): lusijewelry2006@gmail.com</p>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('order.email'): info@lusijewelry.com</p>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('navigation.address'): ՀՀ ք. Գյումրի Գորկու
                            68/4</p>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('navigation.mob') <span
                                    class="fab fa-whatsapp"></span> <span class="fab fa-viber"></span>: +374 91 33-13-23
                        </p>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('navigation.mob') <span
                                    class="fab fa-whatsapp"></span> <span class="fab fa-viber"></span>: +374 91 999-045
                        </p>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('navigation.mob'): +374 96 999-002</p>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('navigation.mob'): +374 98 97-96-06</p>
                        <p style="font-size: 1.5em;font-weight: bold">@lang('navigation.tel'): +374 312 5-56-51</p>
                    </address>
                </div>
            </div>
        </div>
    </div>
    </div><!--/#contact-page--> 

@endsection