  <!-- Modal -->
<div class="modal fade" id="HistoryModal{{$history->id}}" tabindex="-1" role="dialog" aria-labelledby="ReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" > 
                {{ $history->DataSystem ?? null}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
           </h4>
        </div>
        <div class="modal-body text-left">
            <div class="container-fluid">
            @if(!is_null($history))
            @if( $history->system == 1 || $history->system == 2 || $history->system == 3)
                @include ('certify/cb/check_certificate_cb/history.system01')
            @elseif( $history->system == 4)
               @include ('certify/cb/check_certificate_cb/history.system04')
            @elseif( $history->system == 5)
               @include ('certify/cb/check_certificate_cb/history.system05')
            @elseif( $history->system == 6)
               @include ('certify/cb/check_certificate_cb/history.system06')
            @elseif( $history->system == 7)
                @include ('certify/cb/check_certificate_cb/history.system07')
            @elseif( $history->system == 8)
                @include ('certify/cb/check_certificate_cb/history.system08')
            @elseif( $history->system == 9)
                @include ('certify/cb/check_certificate_cb/history.system09')
            @elseif( $history->system == 10)
                @include ('certify/cb/check_certificate_cb/history.system10')
            @elseif( $history->system == 11)
                 @include ('certify/cb/check_certificate_cb/history.system11')
            @endif
        @else 
        @endif
            </div>
        </div>
      </div>
    </div>
</div>
