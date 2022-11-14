<x-app-layout>
    <div class="m-auto">
        <h1 class="content-left text-3xl text-black pb-8">Account settings</h1>

        <div class="content-center bg-white w-min p-12 m-auto rounded-sm">
            <div class="mb-8 mt-2">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="m-auto w-2/3 rounded-full">
                @else
                    <img src="/images/default_avatar.png" alt="Avatar" class="m-auto w-2/3 rounded-full">
                @endif
            </div>

            <form action="{{ route('user.show') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name">Choose your avatar:</label><br/>
                    <input type="file" class="mt-1">
                </div>

                <div class="mb-6">
                    <label for="name">Name:</label><br/>
                    <input type="text" name="name" size="50" id="name" value="{{ old('name', $user->name) }}" class="p-1">
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email">Email:</label><br/>
                    <input type="email" name="email" size="50" id="email" value="{{ $user->email }}" disabled class="p-1">
                </div>

                <h1 class="text-center mt-20">PASSWORD CHANGE FORM</h1>

                <div class="mb-6">
                    <label for="old_password">Old password:</label><br/>
                    <input type="password" name="old_password" size="50" id="old_password" class="p-1">
                </div>

                <div class="mb-6">
                    <label for="new_password">New password:</label><br/>
                    <input type="password" name="new_password" size="50" id="new_password" class="p-1">
                </div>

                <div class="mb-6">
                    <label for="new_password-confirmation">Confirm new password:</label><br/>
                    <input type="password" name="new_password-confirmation" size="50" id="new_password-confirmation" class="p-1">
                    @error('new_password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center">
                    <button type="submit" class="m-auto mt-8 bg-button text-white rounded-md p-3 inline-block">
                        <i class="fas fa-check mr-3"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
