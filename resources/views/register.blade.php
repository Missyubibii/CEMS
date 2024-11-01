<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./output.css" rel="stylesheet" />
    <title>Đăng ký tài khoản</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="{{ asset('img/Logo2.png') }}" type="image/png">
    @vite('resources/css/app.css')
  </head>
  <body
    class="flex font-poppins items-center justify-center dark:bg-gray-900 min-w-screen min-h-screen"
  >
    <div class="grid gap-8">
      <div
        id="back-div"
        class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-[26px] m-4 ">
        <div
          class="border-[20px] border-transparent rounded-[20px] dark:bg-gray-900 bg-white shadow-lg xl:p-10 2xl:p-10 lg:p-10 md:p-10 sm:p-2 m-2"
        >
        <h1 class="pt-8 pb-6 font-bold dark:text-gray-300 text-5xl text-center cursor-default">
            Đăng ký
          </h1>
                    <!-- Hiển thị thông báo lỗi tổng quát -->
            @if (session('error'))
                <p class="text-red-500 text-sm">{{ session('error') }}</p>
            @endif
            <form action="{{route('account.processRegister')}}" method="post" class="space-y-4">
                @csrf
                {{-- Nhập họ và tên --}}
                <div>
                    <label for="name" class="mb-2  dark:text-gray-400 text-lg">Họ và tên</label>
                    <input
                    id="name" name="name" value="{{old('name')}}"
                    class=" @error('name')
                        is-invalid 
                    @enderror border p-3 dark:bg-gray-100 dark:text-gray-950  dark:border-gray-700 shadow-md placeholder:text-base focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                    type="text"
                    placeholder="Nhập họ và tên..."
                    />
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                </div>
                {{-- nhập email --}}
                <div>
                <label for="email" class="mb-2  dark:text-gray-400 text-lg">Email</label>
                <input
                    id="email" name="email" value="{{old('email')}}"
                    class=" @error('email')
                        is-invalid 
                    @enderror border p-3 dark:bg-gray-100 dark:text-gray-950 dark:border-gray-700 shadow-md placeholder:text-base focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                    type="email"
                    placeholder="Nhập Email..."
                />
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                </div>
                {{-- nhập số điện thoại --}}
                <div>
                    <label for="phone" class="mb-2 dark:text-gray-400 text-lg">Nhập số điện thoại</label>
                    <input
                    id="phone" name="phone" alue="{{old('phone')}}"
                    class=" @error('phone')
                        is-invalid 
                    @enderror border dark:bg-gray-100 dark:text-gray-950 dark:border-gray-700 p-3 mb-2 shadow-md placeholder:text-base border-gray-300 rounded-lg w-full focus:scale-105 ease-in-out duration-300"
                    type="tel"
                    placeholder="Nhập số điện thoại..."
                    />
                    @error('phone')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                </div>
                {{-- Nhập mật khẩu --}}
                <div>
                <label for="password" class="mb-2 dark:text-gray-400 text-lg">Mật khẩu</label>
                <input
                    id="password" name="password"
                    class="@error('password')
                        is-invalid
                    @enderror border p-3 shadow-md dark:bg-gray-100 dark:text-gray-950  dark:border-gray-700 placeholder:text-base focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                    type="password"
                    placeholder="Nhập mật khẩu..."
                />
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                </div>

                <div>
                    <label for="confirm_password" class="mb-2 dark:text-gray-400 text-lg">Nhập lại mật khẩu</label>
                    <input
                    id="password_confirmation" name="password_confirmation"
                    class="@error('password_confirmation')
                        is-invalid
                    @enderror border dark:bg-gray-100 dark:text-gray-950 dark:border-gray-700 p-3 mb-2 shadow-md placeholder:text-base border-gray-300 rounded-lg w-full focus:scale-105 ease-in-out duration-300"
                    type="password"
                    placeholder="Nhập lại mật khẩu..."
                    />
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button
                class="bg-gradient-to-r from-blue-500 to-purple-500 shadow-lg mt-6 p-2 text-white rounded-lg w-full hover:scale-105 hover:from-purple-500 hover:to-blue-500 transition duration-300 ease-in-out"
                type="submit"
                >
                Đăng ký
                </button>
            </form>
          <div class="flex flex-col mt-4 items-center justify-center text-sm">
            <h3>
              <span class="cursor-default dark:text-gray-300">Đã có tài khoản</span>
              <a
                class="group text-blue-400 transition-all duration-100 ease-in-out"
                href="{{route('account.login')}}"
              >
                <span
                  class="bg-left-bottom ml-1 bg-gradient-to-r from-blue-400 to-blue-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out"
                >
                  Đăng nhập
                </span>
              </a>
            </h3>
          </div>

          <!-- Third Party Authentication Options -->
          {{-- <div
          id="third-party-auth"
          class="flex items-center justify-center mt-5 flex-wrap"
        >
          <button
            href="#"
            class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1"
          >
            <img
              class="max-w-[25px]"
              src="https://ucarecdn.com/8f25a2ba-bdcf-4ff1-b596-088f330416ef/"
              alt="Google"
            />
          </button>
          <button
            href="#"
            class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1"
          >
            <img
              class="max-w-[25px]"
              src="https://ucarecdn.com/95eebb9c-85cf-4d12-942f-3c40d7044dc6/"
              alt="Linkedin"
            />
          </button>
          <button
            href="#"
            class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1"
          >
            <img
              class="max-w-[25px] filter dark:invert"
              src="https://ucarecdn.com/be5b0ffd-85e8-4639-83a6-5162dfa15a16/"
              alt="Github"
            />
          </button>
          <button
            href="#"
            class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1"
          >
            <img
              class="max-w-[25px]"
              src="https://ucarecdn.com/6f56c0f1-c9c0-4d72-b44d-51a79ff38ea9/"
              alt="Facebook"
            />
          </button>
          <button
            href="#"
            class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1"
          >
            <img
              class="max-w-[25px] dark:gray-100"
              src="https://ucarecdn.com/82d7ca0a-c380-44c4-ba24-658723e2ab07/"
              alt="twitter"
            />
          </button>

          <button
            href="#"
            class="hover:scale-105 ease-in-out duration-300 shadow-lg p-2 rounded-lg m-1"
          >
            <img
              class="max-w-[25px]"
              src="https://ucarecdn.com/3277d952-8e21-4aad-a2b7-d484dad531fb/"
              alt="apple"
            />
          </button>
        </div> --}}
        <div class="text-gray-500 flex text-center flex-col mt-4 items-center text-sm">
            <p class="cursor-default">
                Bằng cách đăng nhập, bạn đồng ý với của chúng tôi
              <a
                class="group text-blue-400 transition-all duration-100 ease-in-out"
                href="#"
              >
                <span
                  class="cursor-pointer bg-left-bottom bg-gradient-to-r from-blue-400 to-blue-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out"
                >
                  điều khoản
                </span>
              </a>
              và
              <a
                class="group text-blue-400 transition-all duration-100 ease-in-out"
                href="#"
              >
                <span
                  class="cursor-pointer bg-left-bottom bg-gradient-to-r from-blue-400 to-blue-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out"
                >
                  chính sách bảo mật
                </span>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
