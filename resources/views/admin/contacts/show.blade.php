@extends('layouts.backend.admin')

@section('title', 'Thông tin liên hệ')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý liên hệ',
            'url' => route('admin.contacts.index')
            ],
            [
                'text' => 'Thông tin liên hệ',
            ],
        ]
    ])
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><b>@yield('title')</b></div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <th width="20%">ID</th>
                                    <td>{{ $contact->id }}</td>
                                </tr>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <td>{{ $contact->subject }}</td>
                                </tr>
                                <tr>
                                    <th>Lời nhắn</th>
                                    <td>{{ $contact->message }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th>Tên</th>
                                    <td>{{ $contact->name}}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ App\Models\Contact::$statuses[$contact->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Phản hồi</th>
                                    <td>{{ $contact->feedback }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $contact->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.contacts.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="{{ '#feedbackModal' }}" class="btn btn-primary">
                                        <span><i class="far fa-share-square"></i></span>Phản hồi
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal cancel -->
                        <div class="modal fade" id="{{ 'feedbackModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="width: 125%">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Phản hồi liên hệ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-group" method="POST" action="{{ route('admin.contacts.feedback', $contact->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <label>Phản hồi
                                                <span class="required-label">*</span>
                                            </label>
                                            <textarea type="text" name="feedback" rows="7" class="form-control"></textarea>
                                            <br>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <button class="btn btn-success" type="submit">Xác nhận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
