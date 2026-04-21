<div style="display: flex; justify-content: center; align-items: center; height: 100vh; font-family: sans-serif; background: #f4f7f6;">
    <form method="POST" action="{{ route('login.post') }}" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px;">
        @csrf
        <h2 style="text-align: center;">Nexout Login</h2>
        <div style="margin-bottom: 15px;">
            <label>Email</label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label>Password</label>
            <input type="password" name="password" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background: #000; color: white; border: none; border-radius: 5px; cursor: pointer;">Login</button>
    </form>
</div>