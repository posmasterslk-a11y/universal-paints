import fs from 'fs/promises';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const dirsToScan = [
  path.join(__dirname, 'app'),
  path.join(__dirname, 'components'),
  path.join(__dirname, 'layouts'),
  path.join(__dirname, 'pages'),
  path.join(__dirname, 'nuxt.config.ts')
];

async function replaceInFile(filePath) {
  try {
    const content = await fs.readFile(filePath, 'utf-8');
    const newContent = content.replace(/\.(png|jpg|jpeg)/gi, '.webp');
    if (content !== newContent) {
      await fs.writeFile(filePath, newContent, 'utf-8');
      console.log(`Updated paths in: ${filePath}`);
    }
  } catch (err) {
    if (err.code !== 'EISDIR' && err.code !== 'ENOENT') {
      console.error(`Error reading ${filePath}:`, err);
    }
  }
}

async function processDirectory(dir) {
  try {
    const stat = await fs.stat(dir);
    if (stat.isFile()) {
      if (dir.endsWith('.vue') || dir.endsWith('.ts') || dir.endsWith('.js') || dir.endsWith('.css')) {
        await replaceInFile(dir);
      }
      return;
    }
    
    const entries = await fs.readdir(dir, { withFileTypes: true });
    for (const entry of entries) {
      const fullPath = path.join(dir, entry.name);
      if (entry.isDirectory() && entry.name !== 'node_modules' && entry.name !== '.nuxt' && entry.name !== '.output') {
        await processDirectory(fullPath);
      } else if (entry.isFile() && (entry.name.endsWith('.vue') || entry.name.endsWith('.ts') || entry.name.endsWith('.js') || entry.name.endsWith('.css'))) {
        await replaceInFile(fullPath);
      }
    }
  } catch (err) {
    if (err.code !== 'ENOENT') {
      console.error(`Error processing ${dir}:`, err);
    }
  }
}

async function run() {
  for (const dir of dirsToScan) {
    await processDirectory(dir);
  }
  console.log('Finished updating image paths.');
}

run();
