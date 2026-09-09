<footer class="bg-white border-t border-emerald-50" aria-labelledby="footer-heading">
  <h2 id="footer-heading" class="sr-only">پابرگ</h2>
  <div class="max-w-4xl mx-auto px-4 pb-8">
    <!-- <div class="mt-16 border-t border-emerald-900/5 pt-8 sm:mt-20 lg:mt-24 lg:flex lg:items-center lg:justify-between">
      <div>
        <h3 class="text-sm font-semibold leading-6 text-gray-800">عضویت در خبرنامه</h3>
        <p class="mt-2 text-sm leading-6 text-gray-500">برای اطلاع از جدیدترین دروس بارگذاری شده در سایت شماره موبایل خود را ثبت کنید</p>
      </div>
      <form class="mt-6 sm:flex sm:max-w-md lg:mt-0">
        <label for="phone-number" class="sr-only">شماره موبایل</label>
        <input type="text" name="phone-number" id="phone-number" autocomplete="off" required class="w-full min-w-0 appearance-none rounded-xl border-0 bg-slate-50 px-4 py-2.5 text-base text-gray-700 shadow-sm ring-1 ring-inset ring-emerald-100 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:w-56 sm:text-sm sm:leading-6 transition-all" placeholder="شماره موبایل شما">
        <div class="mt-4 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
          <button type="submit" class="flex w-full items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 mr-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all">عضویت در خبرنامه</button>
        </div>
      </form>
    </div> -->
    
    <div class="mt-8 border-t border-emerald-50 pt-8 md:flex md:items-center md:justify-between">
      <div class="flex gap-8 md:order-2">
        <!-- Upgraded the Eitaa link to look like a soft modern academic "pill/badge" -->
        <a href="https://eitaa.com/ostadhosseinyamoli" class="inline-flex items-center text-emerald-700 text-xs font-semibold bg-emerald-50 hover:bg-emerald-100 px-4 py-2 rounded-xl transition-colors duration-200">
          کانال دروس در ایتا
        </a>
      </div>
      <p class="mt-8 text-xs leading-5 text-gray-500 md:order-1 md:mt-0">&copy; 1445 سایت توسط جمعی از شاگردان <a
          href='/' class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors">آیت الله حسینی آملی حفظه الله</a> مدیریت می شود.</p>
    </div>
  </div>

  <!-- Modernized Back to Top button with glass/floating effect and nice hover animation -->
  <a id="top" class="fixed bottom-6 left-6 z-[1000] bg-white border border-emerald-50 p-3 rounded-2xl shadow-xl shadow-emerald-900/10 hover:-translate-y-1 hover:bg-emerald-50 cursor-pointer transition-all duration-300 scroll-smooth flex items-center justify-center">
    <?php echo get_svg_icon('arrow-up', '', 'h-6 w-6 text-emerald-600'); ?>
  </a>

</footer>

<?php wp_footer(); ?>
</body>

</html>