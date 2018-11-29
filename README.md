# Installation
Valet requires macOS and Homebrew. Before installation, you should make sure that no other programs such as Apache or Nginx are binding to your local machine's port 80.

- Install or update Homebrew to the latest version using `brew update`.
- Install PHP 7.2 using Homebrew via `brew install php@7.2`.
- Install Composer.
- Install Valet with Composer via `composer global require laravel/valet`. Make sure the `~/.composer/vendor/bin` directory is in your system's "PATH".
- Run the `valet install` command. This will configure and install Valet and DnsMasq, and register Valet's daemon to launch when your system starts.
- Once Valet is installed, try pinging any *.test domain on your terminal using a command such as ping foobar.test. If Valet is installed correctly you should see this domain responding on 127.0.0.1.

Valet will automatically start its daemon each time your machine boots. There is no need to run  `valet start` or `valet install` ever again once the initial Valet installation is complete.

Using Another Domain
By default, Valet serves your projects using the `.test` TLD. If you'd like to use another domain, you can do so using the valet domain tld-name command.

For example, if you'd like to use .app instead of .test, run valet domain app and Valet will start serving your projects at *.app automatically.

Database
If you need a database, try MySQL by running` brew install mysql@5.7` on your command line. Once MySQL has been installed, you may start it using the  brew services start mysql@5.7 command. You can then connect to the database at  127.0.0.1 using the root username and an empty string for the password.

# Serving Sites
Once Valet is installed, you're ready to start serving sites. Valet provides two commands to help you serve your Laravel sites: park and link.

The park Command

Create a new directory on your Mac by running something like mkdir ~/Sites. Next,  cd ~/Sites and run valet park. This command will register your current working directory as a path that Valet should search for sites.
Next, create a new Laravel site within this directory: laravel new blog.
Open http://blog.test in your browser.
That's all there is to it. Now, any Laravel project you create within your "parked" directory will automatically be served using the http://folder-name.test convention.

The link Command

The link command may also be used to serve your Laravel sites. This command is useful if you want to serve a single site in a directory and not the entire directory.

To use the command, navigate to one of your projects and run valet link app-name in your terminal. Valet will create a symbolic link in ~/.config/valet/Sites which points to your current working directory.
After running the link command, you can access the site in your browser at  http://app-name.test.
To see a listing of all of your linked directories, run the valet links command. You may use  valet unlink app-name to destroy the symbolic link.

