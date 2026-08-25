import fs from 'fs/promises';
import path from 'path';
import sharp from 'sharp';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const imagesDir = path.join(__dirname, 'frontend', 'public', 'images');

async function processDirectory(dir) {
  const entries = await fs.readdir(dir, { withFileTypes: true });
  for (const entry of entries) {
    const fullPath = path.join(dir, entry.name);
    if (entry.isDirectory()) {
      await processDirectory(fullPath);
    } else if (entry.isFile() && (entry.name.endsWith('.jpg') || entry.name.endsWith('.png') || entry.name.endsWith('.jpeg'))) {
      const ext = path.extname(entry.name);
      const webpPath = fullPath.replace(new RegExp(`${ext}$`), '.webp');
      
      try {
        await sharp(fullPath).webp({ quality: 80 }).toFile(webpPath);
        console.log(`Converted: ${path.relative(imagesDir, fullPath)} -> ${path.relative(imagesDir, webpPath)}`);
        // Remove original
        await fs.unlink(fullPath);
      } catch (err) {
        console.error(`Failed to convert ${fullPath}:`, err);
      }
    }
  }
}

processDirectory(imagesDir).then(() => console.log('Done.')).catch(console.error);
