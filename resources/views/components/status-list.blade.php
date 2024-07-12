@props(['data'])

<div class='my-1 bg-light-{{ $data->status->getLabelColor() }} rounded p-3'>
  <div class='d-flex flex-column'>
    <div class='text-{{ $data->status->getLabelColor() }} font-weight-lighter font-size-sm'>
      {{ $data->message }}
    </div>
    <div class='separator separator-{{ $data->status->getLabelColor() }} separator-dashed my-1'></div>
    <div class='w-100'>
      <span class='font-weight-bold font-size-sm text-{{ $data->status->getLabelColor() }} align-middle'>
        {{ formatTime($data->created_at) }}
      </span>
      <span class='text-{{ $data->status->getLabelColor() }} font-weight-lighter font-size-sm'>
        &nbsp; ({{ formatTDFH($data->created_at) }})
      </span>
    </div>
  </div>
</div>
