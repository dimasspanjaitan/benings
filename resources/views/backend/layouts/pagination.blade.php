{{-- Pagination --}}
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item {{ empty($pagination['pages']) ? 'disabled' : '' }}">
        <a class="page-link" href="{{ Request::url().'?_limit='.$pagination['_limit'].'&_page=1' }}" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item {{ empty($pagination['pages']) ? 'disabled' : '' }}">
        <a class="page-link" href="{{ Request::url().'?_limit='.$pagination['_limit'].'&_page='.$pagination['prev']}}" tabindex="-1">Prev</a>
      </li>
      @foreach ($pagination['pages'] as $page)
        <li class="page-item"><a class="page-link" href="{{ Request::url().'?_limit='.$pagination['_limit'].'&_page='.$page}}">{{ $page }}</a></li>
      @endforeach
      <li class="page-item {{ empty($pagination['pages']) ? 'disabled' : '' }}">
        <a class="page-link" href="{{ Request::url().'?_limit='.$pagination['_limit'].'&_page='.$pagination['next']}}" >Next</a>
      </li>
      <li class="page-item {{ empty($pagination['pages']) ? 'disabled' : '' }}">
        <a class="page-link" href="{{ Request::url().'?_limit='.$pagination['_limit'].'&_page='.$pagination['last'] }}" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>