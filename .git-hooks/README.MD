## pre-commit

This hook is invoked by git-commit[1], and can be bypassed with the --no-verify option.
It takes no parameters, and is invoked before obtaining the proposed commit log message and making a commit.
Exiting with a non-zero status from this script causes the git commit command to abort before creating a commit.

### Starting

```
cd my-project
cd .git
cd hooks
touch pre-commit ## if not exists
chmod +x pre-commit # initialize the git hook
```
