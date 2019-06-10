const fse = require('fs-extra');

(async ({rootDir, targetDir, dirsToDeploy, filesToDeploy}) => {
  try {
    dirsToDeploy.forEach(async dir => {
      await fse.copy(rootDir + dir, targetDir + dir);
    });

    filesToDeploy.forEach(async file => {
      await fse.copy(rootDir + file, targetDir + file);
    });
    console.log(
      `Files are ready to be deployed: ${await fse.realpath(targetDir)}`
    );
  } catch (e) {
    console.log(e);
  }
})({
  rootDir: './',
  targetDir: './deploy/dist/',
  dirsToDeploy: [
    'assets',
    'build',
    'server'
  ],
  filesToDeploy: [
    'index.php',
    'package.json',
  ],
});
