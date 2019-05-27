
<div class="progress">
  	<div class="progress-bar pb {{{ isset($class) ? $class : 'default' }}} {{{ isset($striped) ? 'progress-bar-striped' : '' }}} {{{ isset($animated) ? 'progress-bar-striped active' : '' }}}" role="progressbar"  aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $value }}" style="width: {{ $value }}%;" >{{{ isset($badge) ? $value: ''}}}
  	</div>
</div>
{{--   --}}
