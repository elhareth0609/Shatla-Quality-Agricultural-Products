@extends('layouts.homeLayout')

@section('title', __('Diseases'))

@section('content')

<div class="container my-1">
  @foreach ($items as $item)
    <a class="checkbox m-1 d-inline-block" @if ($item->status == '1')
    href="{{ route('diseases.predict',$item->id) }}"
    @endif >
      <label class="checkbox-wrapper">
        <span class="checkbox-tile">
          <span class="checkbox-icon">
            <img src="{{ $item->photoUrl() }}" alt="{{ $item->id }}" />
          </span>
          <span class="checkbox-label">{{ $item->name_ar }}</span>
        </span>
      </label>
    </a>
  @endforeach

</div>

<style>

  /* styles.css */

.checkbox-group-legend {
    font-size: 1.5rem;
    font-weight: 700;
    color: #9c9c9c;
    text-align: center;
    line-height: 1.125;
    margin-bottom: 1.25rem;
}

.checkbox-tile {
    border-color: #2260ff;
    box-shadow: 0 5px 10px rgba(#000, 0.1);
    color: #2260ff;
}

.checkbox-tile:before {
    transform: scale(1);
    opacity: 1;
    background-color: #2260ff;
    border-color: #2260ff;
}

.checkbox-tile .checkbox-icon,
.checkbox-tile .checkbox-label {
    color: #2260ff;
}

.checkbox-input:focus + .checkbox-tile {
    border-color: #2260ff;
    box-shadow: 0 5px 10px rgba(#000, 0.1), 0 0 0 4px #b5c9fc;
}

.checkbox-input:focus + .checkbox-tile:before {
    transform: scale(1);
    opacity: 1;
}

.checkbox-tile {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 7rem;
    min-height: 7rem;
    border-radius: 0.5rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(#000, 0.1);
    transition: 0.15s ease;
    cursor: pointer;
}

.checkbox-tile:before {
    content: "";
    position: absolute;
    display: block;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    border-radius: 50%;
    top: 0.25rem;
    left: 0.25rem;
    opacity: 0;
    transform: scale(0);
    transition: 0.25s ease;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
    background-size: 12px;
    background-repeat: no-repeat;
    background-position: 50% 50%;
}

.checkbox-tile:hover {
    border-color: #2260ff;
}

.checkbox-icon {
    transition: .375s ease;
    color: #494949;
}

.checkbox-icon svg {
    width: 3rem;
    height: 3rem;
}

.checkbox-label {
    color: #707070;
    transition: .375s ease;
    text-align: center;
}

</style>
@endsection
