@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Создание заказа') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('order.create') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="fio" class="col-md-4 col-form-label text-md-right">{{ __('ФИО') }}</label>

                                <div class="col-md-6">
                                    <input id="fio" type="text" class="form-control @error('fio') is-invalid @enderror" name="fio" value="{{ old('fio') }}" required autocomplete="fio" autofocus>

                                    @error('fio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="article" class="col-md-4 col-form-label text-md-right">{{ __('Артикул товара') }}</label>

                                <div class="col-md-6">
                                    <input id="article" type="text" class="form-control @error('article') is-invalid @enderror" name="article" value="{{ old('article') }}" required autocomplete="article">

                                    @error('article')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Бренд товара') }}</label>

                                <div class="col-md-6">
                                    <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand">

                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Комментарий') }}</label>

                                <div class="col-md-6">
{{--                                    <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" required autocomplete="brand">--}}
                                    <textarea name="comment" id="comment" cols="38" rows="5">{{ old('comment') }}</textarea>

                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Отправить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
