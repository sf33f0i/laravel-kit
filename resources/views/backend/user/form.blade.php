<div class="form-group">
    <label for="name" class="control-label">Имя <span class="field-required">*<span></label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', $user->name) }}">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="email" class="control-label">Email <span class="field-required">*<span></label>
    <input class="form-control" name="email" type="email" id="email" value="{{ old('email', $user->email) }}">
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="password" class="control-label">Пароль</label>
    <input class="form-control" name="password" type="password" id="password" autocomplete="new-password">
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="role" class="control-label">Роль</label>
    <select name="role" id="role" class="custom-select">
        @foreach($roles as $id => $role)
            <option value="{{ $id }}" {{ $user->hasRole($id) ? 'selected' : ''}}>{{ $role }}</option>
        @endforeach
    </select>
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>



