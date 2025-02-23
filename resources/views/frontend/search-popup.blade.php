<div class="search-popup">
    <div class="search-popup-container">
        <form role="search" method="get" class="form-group" action="{{ route('frontend.search') }}">
            <input type="search" id="search-form" class="form-control border-0 border-bottom"
                placeholder="Type and press enter" value="" name="query" />
            <button type="submit" class="search-submit border-0 position-absolute bg-white"
                style="top: 15px; right: 15px;">
                <svg class="search" width="24" height="24">
                    <use xlink:href="#search"></use>
                </svg>
            </button>
        </form>

        <h5 class="cat-list-title">Duyệt danh mục</h5>
        <ul class="cat-list">
            <li class="cat-list-item"><a href="#" data-id="10" title="Hijab">Hijab</a></li>
            <li class="cat-list-item"><a href="#" data-id="9" title="Abaya">Abaya</a></li>
            <li class="cat-list-item"><a href="#" data-id="5" title="Thobe">Thobe</a></li>
            <li class="cat-list-item"><a href="#" data-id="7" title="Jubah">Jubah</a></li>
            <li class="cat-list-item"><a href="#" data-id="11" title="Niquab">Niquab</a></li>
            <li class="cat-list-item"><a href="#" data-id="20" title="Dầu thơm">Dầu thơm</a></li>
            <li class="cat-list-item"><a href="#" data-id="6" title="Kufi">Kufi</a></li>
        </ul>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const categoryLinks = document.querySelectorAll('.cat-list a');

  categoryLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
      const categoryId = link.getAttribute('data-id'); // Lấy id từ data-id
      window.location.href = `/search?query=${link.getAttribute('title')}&category_id=${categoryId}`; // Truyền query và category_id vào URL
    });
  });
});


</script>
