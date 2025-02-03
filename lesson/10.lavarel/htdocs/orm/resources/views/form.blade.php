@if ($errors->any())
<div style="color:red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif


<div>
    <!-- 上傳照片都需要"multipart/form-data" -->
    <form method="post" enctype="multipart/form-data">
        <!-- 避免前端倒灌 -->
        @csrf
        <!-- value="{{old('uid')}}"可以保留原本的輸入內容 -->
        帳號<input name="uid" value="{{old('uid')}}">
        <p>
            密碼<input type="text" name="password">
        <p>
            <!-- 密碼再次確認 -->
            確認<input type="text" name="password_confirmation">
        <p>
             <!-- 上傳照片 -->
            <input type="file" name="photo">
        <p>
            <input type="submit">
    </form>
</div>