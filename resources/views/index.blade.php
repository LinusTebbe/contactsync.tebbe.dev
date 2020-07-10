@extends('layouts.app')

@section('content')
<div class="two-col-grid">
    <div class="card">
        <h2>Was ist das hier?</h2>
        <p>
            Dieser Dienst ermöglicht es seine Google Kontaktliste als XML zu exportieren, um diese anschließend bspw. automatisiert in ein Grandstream IP Telefon zu importieren.<br>
        </p>
    </div>
    <div class="card">
        <h2>Wie funktioniert es?</h2>
        <p>
            Nach Autorisierung des Google Kontos können Zugriffsdaten erstellt werden.<br>
            Unter Angabe dieser Daten kann auf die XML-API zugegriffen werden, welche automatisch von Google das aktuellste Kontaktbuch in eine passende XML umwandelt.<br>
            <b>Wichtig: Es werden zu keiner Zeit Kontakte gespeichert!</b><br>
            Gespeichert werden lediglich die von Google erhaltenen API-Keys, da diese für die Funktion des Dienstes essentiell sind.
        </p>
    </div>
</div>
<div class="card">
    <h2>Interresiert?</h2>
    <a class="button no-decoration shadow" href="{{ route('login') }}">Los geht's!</a>
</div>
@endsection
