@extends('layouts.master')
@section('title')
    Register
@endsection

@section('content')
    <h1>Buat Account Baru!</h1>
    <h3>Sign Up Form</h3>
    <form action="/welcome" method="POST">
        @csrf
        <label>First Name:</label> <br><br>
        <input type="text" name="firstname"><br><br>
        <label>Last Name:</label> <br><br>
        <input type="text" name="lastname"><br><br>
        <label>Gender:</label> <br><br>
        <input type="radio" name="gender">Male <br>
        <input type="radio" name="gender">Female <br>
        <input type="radio" name="gender">Other <br><br>
        <label>Nationality:</label> <br><br>
        <select name="nationality">
            <option value="indonesian">Indonesian</option>
            <option value="singaporean">Singaporean</option>
            <option value="malaysian">Malaysian</option>
            <option value="australian">Australian</option>
        </select> <br><br>
        <label>Language Spoken:</label> <br><br>
        <input type="checkbox" name="Language">Bahasa Indonesia <br>
        <input type="checkbox" name="language">English <br>
        <input type="checkbox" name="language">Other <br><br>
        <label>Bio:</label> <br><br>
        <textarea name="bio" cols="30" rows="10"></textarea> <br>
        <input type="submit" value="Sign Up">
    </form>
@endsection
